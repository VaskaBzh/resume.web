<?php

declare(strict_types=1);

namespace App\Actions\WatcherLink;

use App\Models\WatcherLink;

class Delete
{
    public static function execute(WatcherLink $watcherLink): void
    {
        $watcherLink->delete();
    }
}
