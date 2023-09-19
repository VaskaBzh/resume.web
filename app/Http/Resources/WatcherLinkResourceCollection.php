<?php

namespace App\Http\Resources;

use App\Models\WatcherLink;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\WatcherLink */
class WatcherLinkResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(fn (WatcherLink $watcherLink) => [
                'name' => $watcherLink->name,
                'allowed_routes' => $watcherLink->allowed_routes,
                'access_count' => $watcherLink->access_count,
                'url' => config('app.url')
                    . '/watcher?access_key='
                    . $watcherLink->token
                    . '&'
                    . 'puid='
                    . $watcherLink->group_id,
            ]),
        ];
    }
}
