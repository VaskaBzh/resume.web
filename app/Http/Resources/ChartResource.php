<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'ChartResource',
        properties: [
            new OA\Property(
                property: 'values',
                type: 'array',
                items: new OA\Items(
                    properties: [
                        new OA\Property(property: 'x', type: 'integer'),
                        new OA\Property(property: 'y', type: 'integer'),
                    ],
                    type: 'object'
                )
            ),
        ],
        type: 'object'
    )
]
class ChartResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'values' => $this['values']
        ];
    }
}
