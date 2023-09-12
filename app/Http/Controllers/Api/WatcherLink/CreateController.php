<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Dto\WatcherLinkData;
use App\Http\Controllers\Controller;
use App\Http\Requests\WatcherLinkRequest;
use App\Models\Sub;
use App\Services\Internal\WatcherLinkService;

class CreateController extends Controller
{
    public function __invoke(
        WatcherLinkRequest $request,
        Sub     $sub,
    )
    {
        WatcherLinkService::withParams(
            watcherLinkData: WatcherLinkData::fromRequest([
                'name' => $request->name,
                'sub' => $sub,
                'user' => auth()->user(),
                'allowedRoutes' => $request->allowed_routes,
            ])
        )->createLink();
    }
}
