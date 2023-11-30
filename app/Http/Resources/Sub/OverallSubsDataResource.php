<?php

declare(strict_types=1);

namespace App\Http\Resources\Sub;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'OverallSubsDataResource',
        properties: [
            new OA\Property(property: 'total_hash_per_day', type: 'float'),
            new OA\Property(property: 'total_hash_day_unit', type: 'string'),
            new OA\Property(property: 'total_hash_per_min', type: 'float'),
            new OA\Property(property: 'total_hash_per_min_unit', type: 'string'),
            new OA\Property(property: 'total_active_workers', type: 'integer'),
            new OA\Property(property: 'total_inactive_workers', type: 'integer'),
            new OA\Property(property: 'total_dead_workers', type: 'integer'),
        ],
        type: 'object'
    )
]
class OverallSubsDataResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'total_hash_per_day' => $this->resource->totalHashPerDay,
            'total_hash_per_day_unit' => $this->resource->perDayUnit,
            'total_hash_per_min' => $this->resource->totalHashPerMin,
            'total_hash_per_min_unit' => $this->resource->perMinUnit,
            'total_active_workers' => $this->resource->totalActiveWorkers,
            'total_inactive_workers' => $this->resource->totalInactiveWorkers,
            'total_dead_workers' => $this->resource->totalDeadWorkers,
        ];
    }
}
