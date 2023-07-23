<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

readonly class WalletData
{
    public function __construct(
        public ?string $name,
        public string $walletAddress,
        public int $groupId,
        public ?int $percent,
        public ?float $minWithdrawal,
        public ?float $payment,
    )
    {
    }

    public static function fromRequest(array $requestData): WalletData
    {
        return new self(
            name: Arr::get($requestData, 'name'),
            walletAddress: $requestData['wallet'],
            groupId: (int) $requestData['group_id'],
            percent: (int) Arr::get($requestData, 'percent'),
            minWithdrawal: (float) Arr::get($requestData, 'minWithdrawal'),
            payment: Arr::get($requestData, 'payment')
        );
    }
}
