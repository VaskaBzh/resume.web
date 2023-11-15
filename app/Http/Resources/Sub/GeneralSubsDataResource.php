<?php

declare(strict_types=1);

namespace App\Http\Resources\Sub;

use App\ValueObjects\HashRate;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'GeneralSubsDataResource',
        properties: [
            new OA\Property(property: 'total_hash_rate', type: 'float'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'total_hash_rate_unit', type: 'string'),
            new OA\Property(property: 'total_active_workers', type: 'integer'),
            new OA\Property(property: 'total_inactive_workers', type: 'integer'),
        ],
        type: 'object'
    )
]
class GeneralSubsDataResource extends JsonResource
{
    public function toArray($request): array
    {
        $totalHashPerDay = HashRate::from($this->sum('hash_per_day'));

        return [
            'total_hash_per_day' => $totalHashPerDay->value,
            'per_day_unit' => $totalHashPerDay->unit,
            'total_active_workers' => $this->sum('workers_count_active'),
            'total_inactive_workers' => $this->sum('workers_count_inactive'),
        ];
    }
}
