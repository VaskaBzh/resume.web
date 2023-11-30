<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkerResource;
use App\Models\Worker;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: '/workers/worker/{worker}',
        summary: 'Get worker',
        security: [['bearer' => []]],
        tags: ['Worker'],
        parameters: [
            new OA\Parameter(
                name: 'worker',
                description: "Worker's ID",
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
                        ref: '#/components/schemas/WorkerResource',
                        type: 'object',
                    ),
                ],
            ),
            new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: 'Not Found',
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
class ShowController extends Controller
{
    public function __invoke(Worker $worker): WorkerResource
    {
        return new WorkerResource($worker);
    }
}
