<?php

namespace App\Http\Resources;

use App\Models\WatcherLink;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/** @see WatcherLink */

#[
    OA\Schema(
        schema: 'WatcherLinkResource',
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'user_id', type: 'integer'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(
                property: 'allowed_routes',
                type: 'array',
                items: new OA\Items(ref: '#/components/schemas/AllowedRouteResource')
            ),
            new OA\Property(property: 'access_count', type: 'integer'),
            new OA\Property(property: 'url', type: 'string'),
        ],
        type: 'object'
    )
]
class WatcherLinkResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'allowed_routes' => new AllowedRouteResource($this),
            'access_count' => $this->access_count,
            'url' => config('app.url')
                . '/watcher?access_key='
                . $this->token
                . '&'
                . 'puid='
                . $this->group_id,
        ];
    }
}
