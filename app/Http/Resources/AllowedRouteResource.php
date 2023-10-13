<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\WatcherLink;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @see WatcherLink
 *
 * @OA\Schema(
 *     schema="AllowedRouteResource",
 *     type="object",
 *     @OA\Property(
 *         property="allowed_routes",
 *         type="array",
 *         @OA\Items(type="string"),
 *     ),
 * )
 */
class AllowedRouteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'allowed_routes' => $this->allowed_routes
        ];
    }
}
