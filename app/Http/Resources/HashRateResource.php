<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'HashRateResource',
        properties: [
            new OA\Property(property: 'hash', type: 'decimal'),
            new OA\Property(property: 'unit', type: 'string'),
            new OA\Property(property: 'worker_count', type: 'integer'),
            new OA\Property(property: 'day_at', type: 'string'),
            new OA\Property(property: 'hour_at', type: 'string'),
        ],
        type: 'object'
    )
]
class HashRateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'hash' => (float) $this->hash,
            'unit' => $this->unit,
            'worker_count' => $this->worker_count,
            'day_at' => $this->created_at->format('Y.m.d'),
            'hour_at' => $this->created_at->format('H:m'),
        ];
    }
}
