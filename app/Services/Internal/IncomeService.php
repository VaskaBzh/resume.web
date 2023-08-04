<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Income\Complete;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Sub\Update;
use App\Dto\IncomeData;
use App\Dto\SubData;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Helper;
use App\Models\Income;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\BtcComService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class IncomeService
{
    public const ALLBTC_FEE = 1.5;
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

    public function getPayment(float $accumulatedAmount): float
    {
        return $this->params['dailyAmount'] + $accumulatedAmount;
    }

    public function getIncomeParam(string $key)
    {
        return Arr::get($this->params, $key);
    }

    public function sumTotalAmount(float $totalAmount): IncomeService
    {
        $this->params['totalAmount'] = $this->params['dailyAmount'] + $totalAmount;

        return $this;
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

    public function sumTotalPayment(float $accumulatedAmount, float $totalPayment): IncomeService
    {
        $this->params['totalPayment'] = $totalPayment
            + $this->params['dailyAmount']
            + $accumulatedAmount;

        return $this;
    }

    public function clearAccumulatedAmount(): IncomeService
    {
        $this->params['accumulatedAmount'] = 0;

        return $this;
    }

    public function setStatus(Status $status): IncomeService
    {
        $this->params['status'] = $status->value;

        return $this;
    }

    public function accumulateAmount(float $accumulatedAmount): IncomeService
    {
        $this->params['accumulatedAmount'] = $accumulatedAmount + $this->params['dailyAmount'];

        return $this;
    }

    public function isLessThenMinWithdraw(float $accumulatedAmount): bool
    {
        return ($accumulatedAmount + $this->params['dailyAmount']) < Wallet::MIN_BITCOIN_WITHDRAWAL;
    }

    /**
     *
     * Проверяем хеш рейт
     * Устанавливаем херщрейт сабаккаунта и сложность сети в свойство IncomeData
     *
     * @return bool
     */
    public function hasHashRate(Sub $sub): bool
    {
        $subHashRate = resolve(BtcComService::class)
            ->getSubHashRate($sub);

        if ($subHashRate > 0) {
            $this->params['hash'] = 1;
            $this->params['diff'] = 1;

            return true;
        }

        return false;
    }

    /**
     * Обновляем запись локального саб-аккаунта
     *
     * @return void
     */
    public function updateLocalSub(Sub $sub): void
    {
        Update::execute(
            subData: SubData::fromRequest([
                'user_id' => $sub->user_id,
                'group_id' => $sub->group_id,
                'group_name' => $sub->sub,
                'total_payment' => $this->params['totalPayment'] ?? $sub->total_payment,
                'accumulated_amount' => $this->params['accumulatedAmount'],
                'total_amount' => $this->params['totalAmount']
            ]),
            sub: $sub
        );
    }

    /**
     * Меняем статусы и сообщения на "completed"
     */
    public function complete(Sub $sub, Wallet $wallet): void
    {
        $incomes = Income::getNotCompleted(
            groupId: $sub->group_id
        )->get();

        if ($incomes) {
            Complete::execute(
                incomes: $incomes,
                incomeData: $this->buildDto(sub: $sub, wallet: $wallet)
            );
        }
    }

    /**
     * Создаем запись начисления
     *
     * @return void
     */
    public function createLocalIncome(Sub $sub, ?Wallet $wallet): void
    {
        $income = IncomeCreate::execute(
            incomeData: $this->buildDto($sub, $wallet)
        );

        Log::channel('incomes')
            ->info('INCOME CREATE', $income->toArray());
    }

    public function setDailyAmount(): IncomeService
    {
        $this->params['dailyAmount'] = Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $this->params['hash']
        );

        return $this;
    }

    private function buildDto(Sub $sub, ?Wallet $wallet): IncomeData
    {
        return IncomeData::fromRequest(
            array_merge(
                [
                    'group_id' => $sub->group_id,
                    'wallet' => $wallet?->wallet,
                    'txid' => Arr::get($this->params, 'txid'),
                ],
                $this->params
            )
        );
    }
}
