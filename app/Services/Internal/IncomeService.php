<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Enums\Income\Status;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\BtcComService;


class IncomeService
{
    public const ALLBTC_FEE = 1.5;
    private array $incomeData = [
        'percent' => Wallet::DEFAULT_PERCENTAGE,
        'status' => Status::REJECTED->value,
        'unit' => 'T',
    ];

    private function __construct(
        private array $params,
    )
    {}

    public static function buildWithParams(array $params = []): IncomeService
    {
        $params = self::prepareParams($params);

        return new self($params);
    }

    private static function prepareParams(array $params): array
    {
        $collectedParams = collect($params);

        return $collectedParams->flatMap(static fn(array $param) => [
            'fppsPercent' => $param['more_than_pps96_rate'],
            'difficulty' => $param['diff'],
            'reward_block' => MinerStat::first()->reward_block,
        ])->toArray();
    }

    public function getParams(): array
    {
        return $this->incomeData;
    }

    public function setData(string $key, $value): IncomeService
    {
        $this->incomeData[$key] = $value;

        return $this;
    }

    public function setHashRate(Sub $sub): bool
    {
        $hashRate = resolve(BtcComService::class)
            ->getWorkerList($sub->group_id)
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
     * Посчитать добычу саб-аккаунта
     *
     * $earnTime - время добычи блока с заданным хешрейтом ($share * pow(10, 12))
     * $this->>hashRate - хешрейт
     * $this->>rewardBlock - награда за блок
     * $this->>difficulty - сложность сети биткоина
     * $this->>fppsPercent - F(доход от транзакционных комиссий) + PPS (вознаграждение за блок)
     */
    public function getEarn(): float|\Exception
    {
        return match (false) {
            isset($this->params['difficulty']) => throw new \Exception('Не указана сложность сети'),
            isset($this->params['hashRate']) => throw new \Exception('Не указан хэшрейт'),
            isset($this->params['reward_block']) => throw new \Exception('Не указана награда за блок'),
            default => $this->calculate()
        };
    }

    private function calculate(): float
    {
        $secondsPerDay = 86400;
        $earnTime = ($this->params['difficulty'] * pow("2", "32"))
            / (($this->params['hashRate'] * pow("10", "12")) * $secondsPerDay);

        $total = $this->params['reward_block'] / $earnTime;

        return $total + $total * (($this->params['fppsPercent'] - BtcComService::FEE - self::ALLBTC_FEE) / 100);
    }
}
