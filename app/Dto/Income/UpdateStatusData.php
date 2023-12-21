<?php

declare(strict_types=1);

namespace App\Dto\Income;

use App\Dto\DtoContract;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Models\Payout;
use App\Models\Sub;
use App\Models\Wallet;
use Illuminate\Support\Arr;

final readonly class UpdateStatusData implements DtoContract
{
    public function __construct(
        public Sub $sub,
        public Status $status,
        public ?Payout $payout,
        public ?Wallet $wallet,
        public ?Message $message,
    ) {
    }

    public static function fromArray(array $data): UpdateStatusData
    {
        return new self(
            sub: $data['sub'],
            status: $data['status'],
            payout: Arr::get($data, 'payout'),
            wallet: Arr::get($data, 'wallet'),
            message: Arr::get($data, 'message'),
        );
    }
}
