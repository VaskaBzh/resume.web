<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Sub */
class SubResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "name" => $this['sub'],
            "group_id" => $this['group_id'],
            "workers_count_active" => $this['workers_count_active'],
            "workers_count_in_active" => $this['workers_count_in_active'],
            "workers_count_unstable" => $this['workers_count_unstable'],
            "hash_per_min" => $this['hash_per_min'],
            "hash_per_day" => $this['hash_per_day'],
            "today_forecast" => $this['today_forecast'],
            "reject_percent" => $this['reject_percent'],
            "unit" => $this['unit'],
            "total_payout" => $this['total_payout'],
            "yesterday_amount" => $this['yesterday_amount'],
            'pending_amount' => $this['pending_amount']
        ];
    }
}
