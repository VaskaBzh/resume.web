<?php

declare(strict_types=1);

namespace App\Dto\Referral;

final readonly class OverallData
{
    public function __construct(
        public int $groupId,
        public int $attachedReferralsCount,
        public int $activeReferralsCount,
        public float $referralsTotalAmount,
        public float $totalReferralsHashRate,
        public string $hashRateUnit,
    ) {
    }

    public static function fromArray(array $data): OverallData
    {
        return new self(
            groupId: $data['group_id'],
            attachedReferralsCount: $data['attached_referrals_count'],
            activeReferralsCount: $data['active_referrals_count'],
            referralsTotalAmount: $data['referrals_total_amount'],
            totalReferralsHashRate: $data['total_referrals_hash_rate'],
            hashRateUnit: $data['hash_rate_unit'],
        );
    }
}
