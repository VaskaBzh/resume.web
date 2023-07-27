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
use App\Models\Income;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\BtcComService;
use Illuminate\Support\Arr;

class IncomeService
{
    public const ALLBTC_FEE = 3.5;
    private array $incomeData = [
        'status' => Status::REJECTED->value,
        'unit' => 'T',
    ];

    private Sub $sub;

    private array $subData = [];

    private function __construct(
        private array   $params,
        private ?Wallet $wallet = null
    )
    {
    }

    public static function buildWithParams(array $params = []): IncomeService
    {
        $params = self::prepareParams($params);

        return new self($params);
    }

    private static function prepareParams(array $params): array
    {
        return collect($params)->flatMap(static fn(array $param) => [
            'fppsPercent' => $param['more_than_pps96_rate'],
            'difficulty' => $param['diff'],
            'reward_block' => MinerStat::first()->reward_block,
        ])->toArray();
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
            ->getWorkerList($this->sub->group_id)
            ->sum('shares_1d');

        if ($hashRate > 0) {
            $this->params['hashRate'] = $hashRate;
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
        IncomeCreate::execute(
            incomeData: $this->buildDto()
        );
    }

    public function createFinance(float $earn): IncomeService
    {
        $profit = $this->calculateProfit($earn);

        FinanceCreate::execute(
            financeData: FinanceData::fromRequest([
                'group_id' => $this->sub->group_id,
                'earn' => $earn,
                'user_total' => $earn - $profit,
                'profit' => $profit
            ])
        );

        return $this;
    }

    public function getUserAmount(): float|\Exception
    {
        return match (true) {
            !isset($this->params['difficulty']) => throw new \Exception('Не указана сложность сети'),
            !isset($this->params['hashRate']) => throw new \Exception('Не указан хэшрейт'),
            !isset($this->params['reward_block']) => throw new \Exception('Не указана награда за блок'),
            default => $this->calculateUserAmount()
        };
    }

    public function getEarn(): float|\Exception
    {
        return match (true) {
            !isset($this->params['difficulty']) => throw new \Exception('Не указана сложность сети'),
            !isset($this->params['hashRate']) => throw new \Exception('Не указан хэшрейт'),
            !isset($this->params['reward_block']) => throw new \Exception('Не указана награда за блок'),
            default => $this->calculateEarn()
        };
    }

    /**
     * Посчитать добычу саб-аккаунта
     *
     * $earnTime - время добычи блока с заданным хешрейтом ($share * pow(10, 12))
     * $this->>hashRate - хешрейт
     * $this->>rewardBlock - награда за блок
     * $this->>difficulty - сложность сети биткоина
     * $this->>fppsPercent - F(доход от транзакционных комиссий) + PPS (вознаграждение за блок)
     */
    private function calculateUserAmount(): float
    {
        $total = $this->calculateEarn();

        return $total - $total * (self::ALLBTC_FEE / 100);
    }

    /**
     * Посчитать добычу
     */
    private function calculateEarn(): float
    {
        $secondsPerDay = 86400;
        $earnTime = ($this->params['difficulty'] * pow("2", "32"))
            / (($this->params['hashRate'] * pow("10", "12")) * $secondsPerDay);

        $total = $this->params['reward_block'] / $earnTime;

        return $total + $total * (($this->params['fppsPercent'] - BtcComService::FEE) / 100);
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
