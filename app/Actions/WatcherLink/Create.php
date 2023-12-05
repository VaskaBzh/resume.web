<?php

declare(strict_types=1);

namespace App\Actions\WatcherLink;

use App\Dto\WatcherLink\CreateData;
use App\Models\WatcherLink;

class Create
{
    public static function execute(CreateData $watcherLinkData, string $token): WatcherLink
    {
        return WatcherLink::create([
            'name' => $watcherLinkData->name,
            'user_id' => $watcherLinkData->user->id,
            'group_id' => $watcherLinkData->sub->group_id,
            'token' => $token,
            'allowed_routes' => $watcherLinkData->allowedRoutes,
        ]);
    }
}
