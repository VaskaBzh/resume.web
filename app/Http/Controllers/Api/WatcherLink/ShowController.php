<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Http\Controllers\Controller;
use App\Http\Resources\WatcherLinkResource;
use App\Models\WatcherLink;

class ShowController extends Controller
{
    public function __invoke(WatcherLink $watcher): WatcherLinkResource
    {
        $this->authorize('viewOrChange', $watcher);

        return new WatcherLinkResource($watcher);
    }
}
