<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class PoolStatsResource extends JsonResource
{
    #[
        OA\Schema(
            schema: 'PoolStatsResource',
            properties: [
                new OA\Property(property: 'valid', type: 'integer'),
                new OA\Property(property: 'stale', type: 'integer'),
                new OA\Property(property: 'hashrate', type: 'integer'),
                new OA\Property(property: 'miners', type: 'integer'),
                new OA\Property(property: 'workers', type: 'integer'),
                new OA\Property(property: 'fee', type: 'float'),
                new OA\Property(property: 'fee_type', type: 'float'),
                new OA\Property(property: 'minpay', type: 'float'),
                new OA\Property(property: 'maxpay', type: 'float'),
                new OA\Property(property: 'height', type: 'integer'),
                new OA\Property(property: 'reward', type: 'float'),
                new OA\Property(property: 'ticker', type: 'string'),
                new OA\Property(property: 'dualmining', type: 'string'),
                new OA\Property(property: 'name', type: 'string'),
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'date', type: 'string'),
                            new OA\Property(property: 'kind', type: 'string'),
                            new OA\Property(property: 'height', type: 'integer'),
                            new OA\Property(property: 'hash', type: 'string'),
                        ],
                        type: 'object'
                    ),
                ),
            ],
            type: 'object'
        )
    ]
    public function toArray($request): array
    {
        return $this->resource;
    }
}
