<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Worker;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/** @mixin Worker */
#[
    OA\Schema(
        schema: 'WorkerResource',
        properties: [
            new OA\Property(
                property: 'data',
                type: 'array',
                items: new OA\Items(
                    properties: [
                        new OA\Property(property: 'worker_id', type: 'string'),
                        new OA\Property(property: 'worker_name', type: 'string'),
                        new OA\Property(property: 'shares_1m', type: 'string'),
                        new OA\Property(property: 'shares_5m', type: 'string'),
                        new OA\Property(property: 'shares_15m', type: 'string'),
                        new OA\Property(property: 'accept_count', type: 'integer'),
                        new OA\Property(property: 'accept_percent', type: 'integer'),
                        new OA\Property(property: 'reject_percent', type: 'string'),
                        new OA\Property(property: 'last_share_ip', type: 'string'),
                        new OA\Property(property: 'ip2location', type: 'string'),
                        new OA\Property(property: 'last_share_time', type: 'integer'),
                        new OA\Property(property: 'shares_unit', type: 'string'),
                        new OA\Property(property: 'worker_status', type: 'string'),
                        new OA\Property(property: 'shares_1h', type: 'integer'),
                        new OA\Property(property: 'shares_1d', type: 'string'),
                        new OA\Property(property: 'shares_1m_pure', type: 'string'),
                        new OA\Property(property: 'shares_5m_pure', type: 'string'),
                        new OA\Property(property: 'shares_15m_pure', type: 'string'),
                        new OA\Property(property: 'shares_1h_pure', type: 'integer'),
                        new OA\Property(property: 'shares_1d_pure', type: 'integer'),
                        new OA\Property(property: 'shares_1d_unit', type: 'string'),
                    ],
                    type: 'object'
                )
            ),
        ],
        type: 'object'
    )
]
class WorkerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            $this->pool_data
        ];
    }
}
