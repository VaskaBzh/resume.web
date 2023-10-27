<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Actions\WatcherLink\ToggleRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\WatcherLinks\UpdateLinkRequest;
use App\Models\WatcherLink;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class UpdateController extends Controller
{
    #[
        OA\Put(
            path: '/watchers/update/{watcher}',
            summary: 'Update a watcher link',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                description: 'Request body for updating a watcher link',
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
                    name: 'watcher',
                    description: "Watcher Link's ID",
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [new OA\Response(
                response: Response::HTTP_OK,
                description: 'Watcher link updated successfully',
            ),
                new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized',),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Watcher link not found'),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Validation errors',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message']
                                ]
                            ]
                        ),
                    ],
                ),
            ],
        )
    ]
    public function __invoke(
        WatcherLink       $watcher,
        UpdateLinkRequest $request
    )
    {
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
    }
}
