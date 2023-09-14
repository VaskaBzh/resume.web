<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Actions\WatcherLink\ToggleRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\WatcherLinks\UpdateLinkRequest;
use App\Models\Sub;
use App\Models\WatcherLink;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function __invoke(
        Sub               $sub,
        WatcherLink       $watcher,
        UpdateLinkRequest $request
    ) {
        try {
            ToggleRoute::execute(
                watcherLink: $watcher,
                allowedRoutes: $request->allowed_routes
            );

            return new JsonResponse(['message' => 'success']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
