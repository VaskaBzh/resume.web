<?php

declare(strict_types=1);

namespace App\Dto\Income;

use App\Dto\DtoContract;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\Sub;
use App\Models\Wallet;
use App\Utils\HashRateConverter;
use Illuminate\Support\Arr;

final readonly class IncomeCreateData implements DtoContract
{
    /**
     * @param  float  $dailyAmount sub-account dalily amount
     * @param  Type  $type income type
     * @param  ?int  $referralId referrer id
     * @param  Status  $status income status
     * @param  ?Message  $message income message
     * @param  HashRateConverter  $hashrate converted hash rate
     */
    public function __construct(
        public Sub $sub,
        public float $dailyAmount,
        public Type $type,
        public Status $status,
        public HashRateConverter $hashrate,
        public ?int $referralId,
        public ?Wallet $wallet,
        public ?Message $message,
    ) {
    }

    public static function fromArray(array $requestData): IncomeCreateData
    {
        return new self(
            sub: $requestData['sub'],
            dailyAmount: $requestData['dailyAmount'],
            type: $requestData['type'],
            status: $requestData['status'],
            hashrate: $requestData['hash'],
            referralId: Arr::get($requestData, 'referral_id'),
            wallet: Arr::get($requestData, 'wallet'),
            message: Arr::get($requestData, 'message'),
        );
    }
}
