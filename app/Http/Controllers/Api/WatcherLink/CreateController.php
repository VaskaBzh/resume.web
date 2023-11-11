<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Dto\WatcherLinkData;
use App\Http\Controllers\Controller;
use App\Http\Requests\WatcherLinks\CreateLinkRequest;
use App\Http\Resources\WatcherLinkResource;
use App\Models\Sub;
use App\Services\Internal\WatcherLinkService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends Controller
{
    #[
        OA\Post(
            path: '/watchers/create/{sub}',
            summary: 'Create a watcher link',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                description: 'Request body for creating a watcher link',
                required: true,
                content: [
                    new OA\JsonContent(
                        required: ['name', 'allowed_routes'],
                        properties: [
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                maxLength: 16,
                            ),
                            new OA\Property(
                                property: 'allowed_routes',
                                type: 'array',
                                items: new OA\Items(
                                    type: 'string'
                                ),
                            ),
                        ],
                    ),
                ],
            ),
            tags: ['Watcher Links'],
            parameters: [
                new OA\Parameter(
                    name: 'sub',
                    description: "Sub's ID",
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_CREATED,
                    description: 'Watcher link created successfully',
                    content: [
                        new OA\JsonContent(
                            type: 'array',
                            items: new OA\Items(
                                ref: '#/components/schemas/WatcherLinkResource'
                            ),
                        ),
                    ],
                ),
                new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
                new OA\Response(
                    response: Response::HTTP_NOT_FOUND,
                    description: 'Not found',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message'],
                                ],
                            ]
                        ),
                    ],
                ),
            ],
        )
    ]
    public function __invoke(
        CreateLinkRequest $request,
        Sub $sub,
    ): WatcherLinkResource {
        $watcherLink = WatcherLinkService::withParams(
            watcherLinkData: WatcherLinkData::fromRequest([
                'name' => $request->name,
                'sub' => $sub,
                'user' => auth()->user(),
                'allowedRoutes' => $request->allowed_routes,
            ])
        )->createLink();

        return new WatcherLinkResource($watcherLink);
    }
}
