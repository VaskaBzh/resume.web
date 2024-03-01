<?php

declare(strict_types=1);

namespace App\Dto\Income;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\Sub;
use App\Utils\HashRateConverter;
use Illuminate\Support\Arr;

final readonly class IncomeCreateData
{
    /**
     * @param  float  $dailyAmount sub-account dalily amount
     * @param  Type  $type income type
     * @param  ?int  $referralId referrer id
     * @param  Status  $status income status
     * @param  ?Message  $message income message
     * @param  HashRateConverter  $hashrate converted hash rate
     * @param  int  $difficulty network diff
     */
    public function __construct(
        public Sub $sub,
        public float $dailyAmount,
        public Type $type,
        public ?int $referralId,
        public Status $status,
        public ?Message $message,
        public HashRateConverter $hashrate,
        public int $difficulty,
    ) {
    }

    public static function fromRequest(array $requestData): IncomeCreateData
    {
        return new self(
            sub: $requestData['sub'],
            dailyAmount: $requestData['dailyAmount'],
            type: $requestData['type'],
            referralId: $requestData['referral_id'],
            status: $requestData['status'],
            message: Arr::get($requestData, 'message'),
            hashrate: $requestData['hash'],
            difficulty: $requestData['diff'],
        );
    }
}
