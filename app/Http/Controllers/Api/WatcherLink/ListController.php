<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Http\Controllers\Controller;
use App\Http\Resources\WatcherLinkResourceCollection;
use App\Models\Sub;
use App\Models\User;

class ListController extends Controller
{
    public function __invoke(User $user, Sub $sub)
    {
        return new WatcherLinkResourceCollection($sub->watcherLinks);
    }
}
