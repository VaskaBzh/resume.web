<?php

namespace App\Actions\WatcherLink;

use App\Dto\WatcherLinkData;
use App\Models\WatcherLink;

class Create
{
    public static function execute(WatcherLinkData $watcherLinkData, string $token)
    {
        WatcherLink::create([
            'name' => $watcherLinkData->name,
            'user_id' => $watcherLinkData->user->id,
            'group_id' => $watcherLinkData->sub->group_id,
            'token' => $token,
            'allowed_routes' => $watcherLinkData->allowedRoutes
        ]);
    }
}
