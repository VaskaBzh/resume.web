<?php

declare(strict_types=1);

namespace App\Dto;

readonly class WalletData
{
    public function __construct(
        public string $name,
        public string $walletAddress,
        public int $groupId,
        public int $percentage
    )
    {
    }

    public static function fromRequest(array $requestData)
    {
        return new self(
            name: $requestData['name'],
            walletAddress: $requestData['wallet'],
            groupId: (int) $requestData['group_id'],
            percentage: (int) $requestData['percentage']
        );
    }
}
