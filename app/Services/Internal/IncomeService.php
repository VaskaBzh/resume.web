<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Finance\Create;
use App\Actions\Income\Complete;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Sub\Update;
use App\Dto\FinanceData;
use App\Dto\IncomeData;
use App\Dto\SubData;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Helper;
use App\Models\Income;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Wallet;
use Illuminate\Support\Facades\Log;

class IncomeService
{
    private Sub $sub;
    private ?Sub $owner;

    private array $params = [
        'allBtcFee' => 3.5,
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
     * Устанавливаем общий сумму общего и дневного дохода
     *
     * @param Sub $sub
     * @return bool
     */
    public function init(Sub $sub): bool
    {
        $this->sub = $sub;
        $this->owner = $sub->user->owner;

        $this->setHashRate();

        if ($this->params['hash'] <= 0) {
            return false;
        }

        $this->setNetworkDifficulty();
        $this->calculateFee();
        $this->setDailyAmount();
        $this->setPendingAmount();
        $this->sumTotalAmount();
        $this->calculateOwnerProfit();

        Log::channel('incomes')
            ->info('INIT UPDATE INCOME PROCESS ' . $sub->sub);

        return true;
    }

    /**
     * Получить сумму вывода на сервис кошелька
     *
     * @return float
     */
    public function getPayout(): float
    {
        return $this->sub->pending_amount;
    }

    private function setHashRate(): void
    {
        $subHashRate = $this
            ->sub
            ->workers()
            ->sum('approximate_hash_rate');

        $this->params['hash'] = $subHashRate;
    }

    private function setNetworkDifficulty(): void
    {
        $this->params['diff'] = $this->stat->network_difficulty;
    }

    private function setDailyAmount(): void
    {
        $this->params['dailyAmount'] = Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $this->params['hash'],
            allBtcFee: $this->params['allBtcFee']
        );
    }

    public function sumTotalAmount(): void
    {
        $this->params['totalAmount'] = $this->params['dailyAmount'] + $this->sub->total_amount;
    }

    public function setTxId(string $txId): IncomeService
    {
        $this->params['txid'] = $txId;

        return $this;
    }

    public function setMessage(Message $message): IncomeService
    {
        $this->params['message'] = $message->value;

        return $this;
    }

    public function clearPendingAmount(): IncomeService
    {
        $this->params['pendingAmount'] = 0;

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
     * Получаем камиссию allbtc с учетом дискаунта реферальной программы
     *
     * @return float
     */
    public function calculateFee(): void
    {
        $referralUserDiscount = $this
            ->owner
            ?->pivot
            ->user_discount_percent ?? 0;

        $this->params['allBtcFee'] = $this->params['allBtcFee'] - ($referralUserDiscount);
    }

    /**
     * Устанавливаем доход овнера от реферала
     *
     * @return void
     */
    public function calculateOwnerProfit(): void
    {
        if ($this->owner) {
            $this->params['ownerProfit'] = $this->params['dailyAmount'] * ($this->owner->pivot->sub_profit_percent / 100);
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


    private function buildDto(?Wallet $wallet): IncomeData
    {
        return IncomeData::fromRequest(requestData: array_merge([
            'group_id' => $this->sub->group_id,
            'wallet_id' => $wallet?->id,
        ], $this->params)
        );
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
                'total_amount' => $this->params['totalAmount']
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
     * Меняем статусы и сообщения на "completed"
     */
    public function complete(Wallet $wallet): void
    {
        $incomes = Income::getNotCompleted(
            groupId: $this->sub->group_id
        )->get();

        if ($incomes) {
            Complete::execute(
                incomes: $incomes,
                incomeData: $this->buildDto(wallet: $wallet)
            );

            Log::channel('incomes')->info('INCOMES STATUSES CHANGE TO COMPLETE', [
                'sub' => $this->sub->id,
                'wallet' => $wallet->id
            ]);
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
            incomeData: $this->buildDto($wallet)
        );

        if ($this->owner) {
            dd($this->owner->pivot);
            IncomeCreate::execute(
                incomeData: IncomeData::fromRequest([
                    'group_id' => $this->sub->group_id,
                    'wallet_id' => $wallet?->id,
                    'referral_id' => $this->sub->pivot,
                    'dailyAmount' => $this->params['ownerProfit'],
                    'status' => $this->params['status'],
                    'message' => $this->params['message'],
                    'hash' => $this->params['hash'],
                    'diff' => $this->params['diff']
                ])
            );
        }

        Log::channel('incomes')
            ->info('INCOME CREATE', $income->toArray());
    }

    /**
     * Создаем запись в таблице финансов
     *
     * @return void
     */
    public function createFinance(): void
    {
        $earn = ($this->params['dailyAmount'] / (100 - $this->params['allBtcFee'])) * 100;

        Create::execute(financeData: FinanceData::fromRequest([
            'group_id' => $this->sub->group_id,
            'earn' => $earn,
            'user_total' => $this->params['dailyAmount'],
            'percent' => $this->params['allBtcFee'],
            'profit' => $earn - $this->params['dailyAmount'],
        ]));
    }
}
