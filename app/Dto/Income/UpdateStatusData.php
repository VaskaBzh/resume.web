<?php

declare(strict_types=1);

namespace App\Dto\Income;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Models\Sub;
use App\Models\Wallet;
use Illuminate\Support\Arr;

final readonly class UpdateStatusData
{
    public function __construct(
        public Sub $sub,
        public ?Wallet $wallet,
        public Status $status,
        public Message $message,
    ) {
    }

    public static function fromArray(array $data): UpdateStatusData
    {
        return new self(
            sub: $data['sub'],
            wallet: Arr::get($data, 'wallet'),
            status: $data['status'],
            message: $data['message'],
        );
    }
}
