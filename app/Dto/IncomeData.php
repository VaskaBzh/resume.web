<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Models\Wallet;
use Illuminate\Support\Arr;

readonly class IncomeData
{
    public function __construct(
        public int $groupId,
        public ?int $percent,
        public ?string $txid,
        public ?string $wallet,
        public ?float $payment,
        public float $amount,
        public string $unit,
        public string $status,
        public ?string $message,
        public float $hash,
        public int $diff,

    ){}

    public static function fromRequest(array $requestData): IncomeData
    {
        return new self(
            groupId: $requestData['group_id'],
            percent: Arr::get($requestData, 'percent', Wallet::DEFAULT_PERCENTAGE),
            txid: Arr::get($requestData,'txid'),
            wallet: $requestData['wallet'],
            payment: $requestData['payment'],
            amount: $requestData['amount'],
            unit: Arr::get($requestData, 'unit', 'T'),
            status: Arr::get($requestData, 'status', Status::REJECTED->value),
            message: Arr::get($requestData, 'message', Message::NO_WALLET->value),
            hash: $requestData['hash'],
            diff: $requestData['diff'],
        );
    }
}
