<?php

namespace App\Http\Resources;

use App\Models\WatcherLink;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @see WatcherLink
 *
 * @OA\Schema(
 *     schema="WatcherLinkResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="user_id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="allowed_routes", type="array", @OA\Items(ref="#/components/schemas/AllowedRouteResource")),
 *     @OA\Property(property="access_count", type="integer"),
 *     @OA\Property(property="url", type="string"),
 * )
 */
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
