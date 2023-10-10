<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Actions\WatcherLink\ToggleRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\WatcherLinks\UpdateLinkRequest;
use App\Models\WatcherLink;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    public function __invoke(
        WatcherLink       $watcher,
        UpdateLinkRequest $request
    )
    {
        try {
            $this->authorize('viewOrChange', $watcher);

            ToggleRoute::execute(
                watcherLink: $watcher,
                allowedRoutes: $request->allowed_routes
            );

            // TODO: Переписать на DTO & Action
            if ($request->name) {
                $watcher->update(['name' => $request->name]);
            }

            return new JsonResponse(['message' => 'success']);
        } catch (AuthorizationException) {

            return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {

            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
