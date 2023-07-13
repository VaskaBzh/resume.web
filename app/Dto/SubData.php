<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

readonly class SubData
{
    public function __construct(
        public int $userId,
        public int $groupId,
        public string $userName,
        public ?int $payments,
        public ?int $unPayments,
        public ?int $accruals,
    )
    {
    }

    public static function fromRequest(array $requestData): SubData
    {
        return new self(
            userId: $requestData['user_id'],
            groupId: $requestData['group_id'],
            userName: $requestData['group_name'],
            payments: Arr::get($requestData, 'payments'),
            unPayments: Arr::get($requestData, 'unPayments'),
            accruals: Arr::get($requestData, 'accruals')
        );
    }
}
