<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllowedRouteResource;
use App\Models\WatcherLink;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Get(
 *     path="/allowed/{token}",
 *     summary="Get allowed routes for a watcher link",
 *     tags={"Watcher links"},
 *     @OA\Parameter(
 *         name="token",
 *         in="path",
 *         description="Watcher Link Token",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="watcher_link", ref="#/components/schemas/AllowedRouteResource"),
 *         )
 *     ),
 *     @OA\Response(response=404, description="Watcher link not found"),
 * )
 */
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
