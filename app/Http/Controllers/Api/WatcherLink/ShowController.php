<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Http\Controllers\Controller;
use App\Http\Resources\WatcherLinkResource;
use App\Models\WatcherLink;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class ShowController extends Controller
{
    #[
        OA\Get(
            path: '/watchers/{watcher}',
            summary: "Get specified watcher link for a user's sub",
            security: [['bearer' => []]],
            tags: ['Watcher Links'],
            parameters: [
                new OA\Parameter(
                    name: 'watcher',
                    description: "Watcher's ID",
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'Successful response',
                    content: [
                        new OA\JsonContent(
                            type: 'array',
                            items: new OA\Items(
                                ref: '#/components/schemas/WatcherLinkResource'
                            )
                        )
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
                                    'property' => ['message']
                                ]
                            ]
                        ),
                    ],
                )
            ],
        )
    ]
    public function __invoke(WatcherLink $watcher): WatcherLinkResource
    {
        $this->authorize('viewOrChange', $watcher);

        return new WatcherLinkResource($watcher);
    }
}
