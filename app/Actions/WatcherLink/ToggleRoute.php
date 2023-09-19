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
     * @throws \Exception
     */
    public static function execute(
        WatcherLink $watcherLink,
        array $allowedRoutes,
    ): void {
        try {
            $watcherLink->update(['allowed_routes' => $allowedRoutes]);
        } catch (\Exception $e) {
            report($e);

            throw new \Exception('Something went wrong');
        }
    }
}
