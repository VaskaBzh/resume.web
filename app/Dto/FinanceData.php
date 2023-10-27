<?php

declare(strict_types=1);

namespace App\Dto;

readonly final class FinanceData
{
    /**
     * @param int $groupId - id сабаккаунта
     * @param float $earn - общая добыча
     * @param float $userTotal доход сабаккаунта после вычета таксы
     * @param float $percent - величина таксы
     * @param float $profit - доход allbtc
     */
    public function __construct(
        public int $groupId,
        public float $earn,
        public float $userTotal,
        public float $percent,
        public float $profit,
    )
    {
    }

    public static function fromRequest(array $requestData): FinanceData
    {
        return new self(
            groupId: $requestData['group_id'],
            earn: $requestData['earn'],
            userTotal: $requestData['user_total'],
            percent: $requestData['percent'],
            profit: $requestData['profit']
        );
    }
}
