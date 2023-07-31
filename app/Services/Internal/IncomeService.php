<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Income\Complete;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Finance\Create as FinanceCreate;
use App\Actions\Sub\Update;
use App\Dto\FinanceData;
use App\Dto\IncomeData;
use App\Dto\SubData;
use App\Enums\Income\Status;
use app\Helper;
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

    public function setIncomeData(string $key, $value): IncomeService
    {
        $this->incomeData[$key] = $value;

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

    public function setSubData(string $key, $value): IncomeService
    {
        $this->subData[$key] = $value;

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
            ->getSubApproximateHashRate($this->sub);

        if ($hashRate > 0) {
            $this->incomeData['hash'] = $hashRate;
            $this->incomeData['diff'] = $this->params['difficulty'];

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
        $total = Helper::calculateEarn($this->stat);

        return $total - $total * (self::ALLBTC_FEE / 100);
    }

    public function getEarn(): float|\Exception
    {
        return Helper::calculateEarn($this->stat);
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
