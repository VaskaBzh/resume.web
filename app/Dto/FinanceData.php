<?php

declare(strict_types=1);

namespace App\Dto;

readonly class FinanceData
{
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
