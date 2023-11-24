<?php

declare(strict_types=1);

namespace App\Dto\Income;

use App\Models\Wallet;

final readonly class CompleteData
{
    public function __construct(
        public string $status,
        public string $message,
        public ?Wallet $wallet,
    ) {
    }

    public static function fromArray(array $data): CompleteData
    {
        return new self(
            status: $data['status'],
            message: $data['message'],
            wallet: $data['wallet']
        );
    }
}
