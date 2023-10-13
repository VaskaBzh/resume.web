<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Sub;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Sub
 *
 * @OA\Schema(
 *     schema="SubResource",
 *     type="object",
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="group_id", type="integer"),
 *     @OA\Property(property="workers_count_active", type="integer"),
 *     @OA\Property(property="workers_count_in_active", type="integer"),
 *     @OA\Property(property="workers_count_unstable", type="integer"),
 *     @OA\Property(property="hash_per_min", type="integer"),
 *     @OA\Property(property="hash_per_day", type="integer"),
 *     @OA\Property(property="today_forecast", type="integer"),
 *     @OA\Property(property="reject_percent", type="number"),
 *     @OA\Property(property="unit", type="string"),
 *     @OA\Property(property="total_payout", type="number"),
 *     @OA\Property(property="yesterday_amount", type="number"),
 *     @OA\Property(property="pending_amount", type="number"),
 * )
 */
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
