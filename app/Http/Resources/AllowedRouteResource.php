<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\WatcherLink;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @see WatcherLink
 */
#[
    OA\Schema(
        schema: 'AllowedRouteResource',
        properties: [
            new OA\Property(
                property: 'allowed_routes',
                type: 'array',
                items: new OA\Items(type: 'string')
            ),
        ],
        type: 'object'
    )
]
class AllowedRouteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'allowed_routes' => $this->allowed_routes,
        ];
    }
}
