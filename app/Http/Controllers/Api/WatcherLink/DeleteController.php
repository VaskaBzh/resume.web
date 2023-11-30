<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Actions\WatcherLink\Delete;
use App\Http\Controllers\Controller;
use App\Models\WatcherLink;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    #[
        OA\Delete(
            path: '/watchers/delete/{watcher}',
            summary: 'Delete a watcher link',
            security: [['bearer' => []]],
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
            responses: [
                new OA\Response(response: Response::HTTP_OK, description: 'Watcher link deleted successfully'),
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
    public function __invoke(WatcherLink $watcher): JsonResponse
    {
        $this->authorize('viewOrChange', $watcher);

        Delete::execute(watcherLink: $watcher);

        return new JsonResponse(['message' => 'success']);
    }
}
