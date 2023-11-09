<?php

declare(strict_types=1);

namespace App\Http\Resources\Referral;

use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

/** @see Sub */

#[
    OA\Schema(
        schema: 'ReferralResourceCollection',
        properties: [
            new OA\Property(
                property: 'data',
                type: 'array',
                items: new OA\Items(
                    properties: [
                        new OA\Property(property: 'email', type: 'string'),
                        new OA\Property(property: 'referral_active_workers_count', type: 'integer'),
                        new OA\Property(property: 'referral_inactive_workers_count', type: 'integer'),
                        new OA\Property(property: 'referral_hash_per_day', type: 'float'),
                        new OA\Property(property: 'total_amount', type: 'float'),
                        new OA\Property(property: 'referral_percent', type: 'float'),
                    ],
                    type: 'object'
                )
            )
        ],
        type: 'object'
    )
]
class ReferralResourceCollection extends ResourceCollection
{

    public function toArray($request): array
    {
        return [
            'data' => $this->collection
        ];
    }
}
