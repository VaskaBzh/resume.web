<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'ReferralStatisticResource',
        properties: [
            new OA\Property(property: 'group_id', type: 'integer'),
            new OA\Property(property: 'attached_referrals_count', type: 'integer'),
            new OA\Property(property: 'active_referrals_count', type: 'integer'),
            new OA\Property(property: 'referrals_total_amount', type: 'float'),
            new OA\Property(property: 'total_referrals_hash_rate', type: 'float'),
            new OA\Property(property: 'referral_percent', type: 'float'),
            new OA\Property(property: 'code', type: 'string'),
        ],
        type: 'object'
    )
]
class ReferralStatisticResource extends JsonResource
{
    public function __construct(
        User                   $resource,
        private readonly array $statistic,
        private readonly array $referralCodeData
    )
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'group_id' => $this->referralCodeData['group_id'],
            'code' => route('v1.register', 'referral_code=' . $this->referral_code),
            ...$this->statistic,
            'referral_percent' => $this->referralCodeData['referral_percent']
        ];
    }
}
