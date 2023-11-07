<?php

declare(strict_types=1);

namespace App\Http\Resources\Referral;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferralIncomeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "email" => $this->sub->user->email,
            "daily_amount" => $this->daily_amount,
            "hash" => $this->hash,
            "created_at" => $this->created_at,
        ];
    }
}
