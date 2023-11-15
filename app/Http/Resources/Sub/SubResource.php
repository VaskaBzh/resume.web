<?php

declare(strict_types=1);

namespace App\Http\Resources\Sub;

use App\Models\Sub;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/** @mixin Sub */
#[
    OA\Schema(
        schema: 'SubResource',
        properties: [
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'group_id', type: 'integer'),
            new OA\Property(property: 'workers_count_active', type: 'integer'),
            new OA\Property(property: 'workers_count_inactive', type: 'integer'),
            new OA\Property(property: 'workers_count_unstable', type: 'integer'),
            new OA\Property(property: 'hash_per_min', type: 'integer'),
            new OA\Property(property: 'hash_per_day', type: 'integer'),
            new OA\Property(property: 'today_forecast', type: 'integer'),
            new OA\Property(property: 'reject_percent', type: 'number'),
            new OA\Property(property: 'hash_per_day_unit', type: 'string'),
            new OA\Property(property: 'hash_per_min_unit', type: 'string'),
            new OA\Property(property: 'total_payout', type: 'number'),
            new OA\Property(property: 'yesterday_amount', type: 'number'),
            new OA\Property(property: 'pending_amount', type: 'number'),
            new OA\Property(property: 'last_month_amount', type: 'number'),
            new OA\Property(property: 'total_amount', type: 'number'),
        ],
        type: 'object'
    )
]
class SubResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return $this->resource;
    }
}
