<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferralStatisticResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'group_id' => $this->group_id,
            'attached_referrals_count' => $this->referrals()->count(),
            'active_referrals_count' => 0,
        ];
    }
}
