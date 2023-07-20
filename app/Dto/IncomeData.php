<?php

declare(strict_types=1);

namespace App\Dto;

readonly class IncomeData
{
    public function __construct(
        public int $groupId,
        public ?int $percent,
        public ?string $txid,
        public ?string $wallet,
        public ?float $payment,
        public string $amount,
        public string $unit,
        public string $status,
        public ?string $message,
        public string $hash,
        public int $diff,

    )
    {
    }

    public static function fromRequest(array $requestData): IncomeData
    {
        return new self(
            groupId: $requestData['group_id'],
            percent: $requestData['percent'],
            txid: $requestData['txid'],
            wallet: $requestData['wallet'],
            payment: $requestData['payment'],
            amount: $requestData['amount'],
            unit: $requestData['unit'],
            status: $requestData['status'],
            message: $requestData['message'],
            hash: $requestData['hash'],
            diff: $requestData['diff'],
        );
    }
}
