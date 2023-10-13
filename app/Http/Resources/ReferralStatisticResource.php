<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ReferralStatisticResource",
 *     type="object",
 *     @OA\Property(property="group_id", type="integer"),
 *     @OA\Property(property="attached_referrals_count", type="integer"),
 *     @OA\Property(property="active_referrals_count", type="integer"),
 *     @OA\Property(property="referrals_total_amount", type="float"),
 *     @OA\Property(property="code", type="string"),
 * )
 */
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
            'attached_referrals_count' => $this->statistic['attached_referrals_count'],
            'active_referrals_count' => $this->statistic['active_referrals_count'],
            'referrals_total_amount' => $this->statistic['referrals_total_amount'],
            'code' => route('v1.register', 'referral_code=' . $this->referral_code),
        ];
    }
}
