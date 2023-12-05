<?php

declare(strict_types=1);

namespace App\Actions\WatcherLink;

use App\Dto\WatcherLink\UpdateData;

class ToggleRoute
{
    public static function execute(
        UpdateData $updateData,
    ): void {
        $updateData->watcherLink->update(['allowed_routes' => $updateData->allowedRoutes]);

        if ($updateData->name) {
            $updateData->watcherLink->update([
                'name' => $updateData->name,
            ]);
        }
    }
}
