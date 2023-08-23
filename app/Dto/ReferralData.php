<?php

declare(strict_types=1);

namespace App\Dto;

use App\Models\User;

readonly final class ReferralData
{
    public function __construct(
        public User $user,
        public int $group_id,
        public string $code,
        public float $subProfitPercent,
        public float $userDiscountPercent,
    )
    {
    }

    public static function fromRequest(array $requestData): ReferralData
    {
        return new self(
            user: $requestData['user'],
            group_id: (int) $requestData['group_id'],
            code: $requestData['code'],
            subProfitPercent: $requestData['sub_profit_percent'],
            userDiscountPercent: $requestData['user_discount_percent']
        );
    }
}
