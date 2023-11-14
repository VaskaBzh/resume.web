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
        $hashRate = HashRate::from($this->subs->sum('total_hash_rate'));
        $workers = $this->subs->pluck('workers')->flatMap;

        return [
            'total_hash_rate' => $hashRate->value,
            'total_hash_rate_unit' => $hashRate->unit,
            'total_active_workers' => $workers
                ->where('status', 'ACTIVE')
                ->count(),
            'total_inactive_workers' => $workers
                ->where('status', 'ACTIVE')
                ->count(),
        ];
    }
}
