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
    public const ALLBTC_FEE = 3.5;
    private array $incomeData = [
        'status' => Status::REJECTED->value,
        'unit' => 'T',
    ];

    private Sub $sub;
    private array $subData = [];

    public function __construct(
        private MinerStat $stat,
        private ?Wallet $wallet = null
    )
    {
        $this->stat = MinerStat::first();
    }

    public function getIncomeParam(string $key)
    {
        return Arr::get($this->incomeData, $key);
    }

    public function setAmount(float $amount): IncomeService
    {
        $this->incomeData['amount'] = $amount;

        return $this;
    }

    public function setPayment(float $amount): IncomeService
    {
        $this->incomeData['payment'] = $amount + $this->sub->unPayments;

        return $this;
    }

    public function calculatePayment(float $amount): IncomeService
    {
        $this->incomeData['payment'] = ($amount + $this->subData['unPayments']) * ($this->wallet->percent / 100);

        return $this;
    }

    public function setTxId(string $txId): IncomeService
    {
        $this->incomeData['txId'] = $txId;

        return $this;
    }

    public function setMessage(Message $message): IncomeService
    {
        $this->incomeData['message'] = $message->value;

        return $this;
    }

    public function setStatus(Status $status): IncomeService
    {
        $this->incomeData['status'] = $status->value;

        return $this;
    }

    public function setPercent(): IncomeService
    {
        $this->incomeData['percent'] = Wallet::DEFAULT_PERCENTAGE;

        return $this;
    }

    public function canWithdraw(): bool
    {
        return $this->incomeData['payment'] >= Wallet::MIN_BITCOIN_WITHDRAWAL;
    }

    public function setSubClearPayments(): IncomeService
    {
        $this->subData['payments'] = $this->sub->payments;

        return $this;
    }

    public function setSubPayments(): IncomeService
    {
        $this->subData['payments'] = $this->sub->payments + $this->sub->unPayments;

        return $this;
    }

    public function setSubAccruals(float $amount = 0): IncomeService
    {
        $this->subData['accruals'] = $this->sub->accruals + $amount;

        return $this;
    }

    public function setSubUnPayments(): IncomeService
    {
        $this->subData["unPayments"] = $this->subData["accruals"] - $this->subData["payments"];

        return $this;
    }

    public function setSub(Sub $sub): IncomeService
    {
        $this->sub = $sub;

        return $this;
    }

    public function setWallet(Wallet $wallet): IncomeService
    {
        $this->wallet = $wallet;

        return $this;
    }

    /**
     *
     * Проверяем хеш рейт
     * Устанавливаем херщрейт и сложность сети в свойство IncomeData
     *
     * @return bool
     */
    public function setHashRate(): bool
    {
        $hashRate = resolve(BtcComService::class)
            ->getSubHashRate($this->sub);

        if ($hashRate > 0) {
            $this->incomeData['hash'] = $hashRate;
            $this->incomeData['diff'] = $this->stat->network_difficulty;

            return true;
        }

        return false;
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
                'payments' => $this->subData['payments'],
                'unPayments' => $this->subData['unPayments'],
                'accruals' => $this->subData['accruals']
            ]),
            sub: $this->sub
        );
    }

    /**
     * Меняем статусы и сообщения на "completed"
     */
    public function complete(): void
    {
        $incomes = Income::getNotCompleted(
            groupId: $this->sub->group_id
        )->get();

        if ($incomes) {
            Complete::execute(
                incomes: $incomes,
                incomeData: $this->buildDto()
            );
        }
    }

    /**
     * Создаем запись начисления
     *
     * @return void
     */
    public function createLocalIncome(): void
    {
        $income = IncomeCreate::execute(
            incomeData: $this->buildDto()
        );

        Log::channel('incomes')
            ->info('INCOME CREATE', $income->toArray());
    }

    public function getUserAmount(): float
    {
        return Helper::calculateEarn(
            stats: $this->stat,
            hashRate: $this->incomeData['hash']
        );
    }

    private function calculateProfit(float $earn): float
    {
        return ($earn / 100) * self::ALLBTC_FEE;
    }

    private function buildDto(): IncomeData
    {
        return IncomeData::fromRequest(
            array_merge(
                [
                    'group_id' => $this->sub->group_id,
                    'wallet' => $this->wallet?->wallet,
                    'txid' => Arr::get($this->incomeData, 'txid'),
                ],
                $this->incomeData
            )
        );
    }
}
