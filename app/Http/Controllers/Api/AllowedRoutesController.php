<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllowedRouteResource;
use App\Models\WatcherLink;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

#[
    OA\Get(
        path: '/allowed/{token}',
        summary: 'Get allowed routes for a watcher link',
        security: [['bearerAuth' => []]],
        tags: ['Watcher Links'],
        parameters: [
            new OA\Parameter(
                name: 'token',
                description: 'Watcher Link Token',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string')
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Successful response',
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'watcher_link',
                                ref: '#/components/schemas/AllowedRouteResource'
                            ),
                        ],
                        type: 'object'
                    )
                ],
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: 'Watcher link not found',
            ),
        ],
    )
]
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
