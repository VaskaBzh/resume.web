<?php

namespace App\Http\Controllers\Api\WatcherLink;

use App\Dto\WatcherLinkData;
use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Services\Internal\WatcherLinkService;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(
        Request $request,
        Sub $sub,
    )
    {
        WatcherLinkService::generateLink(
            watcherLinkData: WatcherLinkData::fromRequest([
                'name' => $request->name,
                'sub' => $sub,
                'allowedViews' => $request->allowed_views,
            ])
        );
    }
}
