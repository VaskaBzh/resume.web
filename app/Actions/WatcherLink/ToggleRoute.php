<?php

declare(strict_types=1);

namespace App\Actions\WatcherLink;

use App\Models\WatcherLink;

class ToggleRoute
{
    /**
     * @param WatcherLink $watcherLink
     * @param array $allowedRoutes
     * @return void
     */
    public static function execute(
        WatcherLink $watcherLink,
        array       $allowedRoutes,
    ): void
    {
        $watcherLink->update(['allowed_routes' => $allowedRoutes]);
    }
}
