<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Http\Controllers\Controller;
use App\Http\Resources\WatcherLinkResource;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;


#[
    OA\Get(
        path: '/watchers/{user}/{sub}',
        summary: "Get watcher links for a user's sub",
        security: [['bearerAuth' => []]],
        tags: ['Watcher Links'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                description: "User's ID",
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
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
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: 'Unauthorized',
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: 'User or sub not found',
            ),
        ],
    )
]

class ListController extends Controller
{
    public function __invoke(User $user, Sub $sub): ResourceCollection
    {
        return WatcherLinkResource::collection($sub->watcherLinks);
    }
}
