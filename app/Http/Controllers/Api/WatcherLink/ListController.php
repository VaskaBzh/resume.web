<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Http\Controllers\Controller;
use App\Http\Resources\WatcherLinkResource;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListController extends Controller
{
    public function __invoke(User $user, Sub $sub): ResourceCollection
    {
        return WatcherLinkResource::collection($sub->watcherLinks);
    }
}
