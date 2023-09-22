<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Actions\WatcherLink\Delete;
use App\Http\Controllers\Controller;
use App\Models\WatcherLink;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    public function __invoke(WatcherLink $watcher): JsonResponse
    {
        try {
            $this->authorize('viewOrChange', $watcher);

            Delete::execute(
                watcherLink: $watcher,
            );

            return new JsonResponse(['message' => 'success']);
        } catch (AuthorizationException) {

            return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {

            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
