<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllowedRouteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'allowed_routes' => $this->allowed_routes
        ];
    }
}
