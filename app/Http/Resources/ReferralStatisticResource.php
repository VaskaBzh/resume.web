<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralStatisticResource extends JsonResource
{
    public function __construct(User $resource, private array $statistic)
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'group_id' => $this->referral_code['group_id'],
            'attached_referrals_count' => $this->statistic['attached_referrals_count'],
            'active_referrals_count' => $this->statistic['active_referrals_count'],
            'referrals_total_amount' => $this->statistic['referrals_total_amount'],
            'code' => $this->referral_code['code'],
        ];
    }
}
