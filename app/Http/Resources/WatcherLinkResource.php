<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\WatcherLink */
class WatcherLinkResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'allowed_routes' => $this->allowed_routes,
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
