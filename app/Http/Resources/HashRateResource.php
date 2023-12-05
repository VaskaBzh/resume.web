<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Utils\HashRateConverter;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'HashRateResource',
        properties: [
            new OA\Property(property: 'hash', type: 'decimal'),
            new OA\Property(property: 'unit', type: 'string'),
            new OA\Property(property: 'worker_count', type: 'integer'),
        ],
        type: 'object'
    )
]
class HashRateResource extends JsonResource
{
    public function toArray($request): array
    {
        $hashRate = HashRateConverter::fromPure($this->hash);

        return [
            'hash' => (float) $hashRate->value,
            'unit' => $hashRate->unit,
            'worker_count' => $this->worker_count,
        ];
    }
}

