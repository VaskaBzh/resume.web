<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Finance\Create;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Sub\Update;
use App\Dto\FinanceData;
use App\Dto\Income\IncomeCreateData;
use App\Dto\SubData;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Models\Wallet;
use App\Services\External\BtcComService;
use App\Utils\Helper;
use Illuminate\Support\Facades\Log;

class IncomeService
{
    private Sub $sub;
    private ?User $referrer;
    private float $dailyEarn;
    private float $fee;

    private array $params = [
        'status' => Status::REJECTED->value,
        'unit' => 'T',
        'totalPayment' => null,
    ];

    public function __construct(
        private MinerStat $stat,
    )
    {
        $this->stat = MinerStat::first();
    }

    /**
     * Устанавливаем хеш-рейт сабаккаунта
     * Устанавливаем дневную доход после вычета коммиссий
     * Устанавливаем доход удержанный на балансе
     * Устанавливаем сумму общего и дневного доходов
     *
     * @param Sub $sub
     * @return bool
     */
    public function init(Sub $sub): bool
    {
        $this->sub = $sub;
        $this->referrer = $sub->user->referrer;

        $this->setHashRate();

        if ($this->params['hash'] <= 0) {
            return false;
        }

        $this->calculateFee();

        $this->setNetworkDifficulty();
        $this->setDailyEarn();
        $this->setDailyAmount();
        $this->setPendingAmount();
        $this->sumTotalAmount();
        $this->calculateOwnerProfit();

        Log::channel('incomes')
            ->info('INIT UPDATE INCOME PROCESS ' . $sub->sub);

        return true;
    }

    private function calculateFee(): void
    {
        $this->fee = $this->referrer
            ? $this->sub->allbtc_fee - $this->referrer->discount_percent
            : $this->sub->allbtc_fee;
    }

    private function setHashRate(): void
    {
        $this->params['hash'] = $this
            ->sub
            ->total_hash_rate;
    }

    private function setNetworkDifficulty(): void
    {
        $this->params['diff'] = $this->stat->network_difficulty;
    }

    private function setDailyEarn(): void
    {
        $this->dailyEarn = Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $this->params['hash'],
            fee: 0
        );
    }

    private function setDailyAmount(): void
    {
        $this->params['dailyAmount'] = Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $this->params['hash'],
            fee: BtcComService::FEE + $this->fee
        );
    }

    public function sumTotalAmount(): void
    {
        $this->params['totalAmount'] = $this->params['dailyAmount'] + $this->sub->total_amount;
    }

    public function setMessage(Message $message): IncomeService
    {
        $this->params['message'] = $message->value;

        return $this;
    }

    public function setStatus(Status $status): IncomeService
    {
        $this->params['status'] = $status->value;

        return $this;
    }

    public function setPendingAmount(): IncomeService
    {
        $this->params['pendingAmount'] = $this->sub->pending_amount + $this->params['dailyAmount'];

        return $this;
    }

    /**
     * Устанавливаем доход овнера от реферала
     *
     * @return void
     */
    public function calculateOwnerProfit(): void
    {
        if ($this->referrer) {
            $this->params['referrerProfit'] = $this->dailyEarn * ($this->referrer->referral_percent / 100);
        }
    }

    /**
     * Проверяем достигнуто ли минимальное значение для вывода средств
     *
     * @return bool
     */
    public function isLessThenMinWithdraw(): bool
    {
        return ($this->sub->pending_amount + $this->params['dailyAmount']) < Wallet::MIN_BITCOIN_WITHDRAWAL;
    }

    /**
     * Проверяем достигнуто ли минимальное значение для вывода средств для рефовода,
     * если такого имеется
     *
     * @return bool
     */
    private function isLessThenMinWithdrawReferrer(): bool
    {
        return ($this->referrer->pending_amount + $this->params['referrerProfit']) < Wallet::MIN_BITCOIN_WITHDRAWAL;
    }

    private function buildDto(?Wallet $wallet): IncomeCreateData
    {
        return IncomeCreateData::fromRequest(requestData: array_merge([
            'group_id' => $this->sub->group_id,
            'wallet_id' => $wallet?->id,
        ], $this->params));
    }

    /**
     * Обновляем запись локального саб-аккаунта
     *
     * @return void
     */
    public function updateLocalSub(): void
    {
        Update::execute(
            subData: SubData::fromRequest([
                'user_id' => $this->sub->user_id,
                'group_id' => $this->sub->group_id,
                'group_name' => $this->sub->sub,
                'pending_amount' => $this->params['pendingAmount'],
                'total_amount' => $this->params['totalAmount'],
            ]),
            sub: $this->sub
        );

        if ($this->owner) {
            Update::execute(
                subData: SubData::fromRequest([
                    'user_id' => $this->owner->user_id,
                    'group_id' => $this->owner->group_id,
                    'group_name' => $this->owner->sub,
                    'pending_amount' => $this->owner->pending_amount + $this->params['ownerProfit'],
                    'total_amount' => $this->owner->total_amount + $this->params['ownerProfit'],
                ]),
                sub: $this->owner
            );
        }
    }

    /**
     * Создаем запись начисления
     *
     * @return void
     */
    public function createLocalIncome(?Wallet $wallet): void
    {
        $income = IncomeCreate::execute(
            incomeCreateData: $this->buildDto($wallet)
        );

        if ($this->owner) {
            $referralIncome = IncomeCreate::execute(
                incomeCreateData: IncomeCreateData::fromRequest([
                    'group_id' => $this->owner->group_id,
                    'wallet_id' => $this
                        ->owner
                        ->wallets()
                        ->first()
                        ?->id,
                    'referral_id' => $this->owner->pivot->id,
                    'dailyAmount' => $this->params['ownerProfit'],
                    'status' => $this->params['status'],
                    'message' => $this->params['message'],
                    'hash' => $this->params['hash'],
                    'diff' => $this->params['diff']
                ])
            );

            Log::channel('incomes')
                ->info(
                    message: "REFERRAL INCOME CREATE FROM {$this->sub->sub} to {$this->owner->sub}",
                    context: $referralIncome->toArray()
                );
        }

        Log::channel('incomes')
            ->info(message: 'INCOME CREATE', context: $income->toArray());
    }

    /**
     * Создаем запись в таблице финансов
     *
     * @return void
     */
    public function createFinance(): void
    {
        Create::execute(financeData: FinanceData::fromRequest([
            'group_id' => $this->sub->group_id,
            'earn' => $this->dailyEarn,
            'user_total' => $this->params['dailyAmount'],
            'percent' => $this->sub->percent,
            'profit' => $this->dailyEarn * (($this->sub->percent + BtcComService::FEE) / 100),
        ]));
    }
}
