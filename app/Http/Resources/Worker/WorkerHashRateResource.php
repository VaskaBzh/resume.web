<?php

declare(strict_types=1);

namespace App\Http\Resources\Worker;

use App\Models\WorkerHashrate;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/** @see WorkerHashrate */
#[
    OA\Schema(
        schema: 'WorkerHashRateResource',
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'hash', type: 'number', format: 'float'),
            new OA\Property(property: 'unit', type: 'string'),
            new OA\Property(property: 'worker_id', type: 'integer'),
        ],
        type: 'object'
    )
]
class WorkerHashRateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'hash' => $this->hash_per_min,
            'unit' => $this->unit,
            'worker_id' => $this->worker_id,
        ];
    }
}
