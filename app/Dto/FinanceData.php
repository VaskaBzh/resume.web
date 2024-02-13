<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class FinanceData
{
    /**
     * @param  int  $groupId - id сабаккаунта
     * @param  float  $earn - общая добыча
     * @param  float  $userTotal доход сабаккаунта после вычета таксы
     * @param  float  $percent - величина таксы
     * @param  float  $clear_percent - величина таксы с учетом рефералки
     * @param  float  $profit - доход allbtc
     */
    public function __construct(
        public int $groupId,
        public float $earn,
        public float $userTotal,
        public float $percent,
        public float $clear_percent,
        public float $profit,
    ) {
    }

    public static function fromRequest(array $requestData): FinanceData
    {
        return new self(
            groupId: $requestData['group_id'],
            earn: $requestData['earn'],
            userTotal: $requestData['user_total'],
            percent: $requestData['percent'],
            clear_percent: $requestData['clear_percent'],
            profit: $requestData['profit']
        );
    }
}
