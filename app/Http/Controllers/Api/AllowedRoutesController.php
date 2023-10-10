<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllowedRouteResource;
use App\Models\WatcherLink;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AllowedRoutesController extends Controller
{
    public function __invoke(string $token)
    {
        $watcherLink = WatcherLink::where('token', $token)->first();

        if (!$watcherLink) {
            return new JsonResponse(['error' => 'Watcher link not exists'], Response::HTTP_NOT_FOUND);
        }

        return new AllowedRouteResource($watcherLink);
    }
}
