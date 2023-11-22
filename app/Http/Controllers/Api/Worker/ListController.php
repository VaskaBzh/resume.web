<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Worker;

use App\Enums\Worker\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkerResource;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: '/workers/{sub}',
        summary: "Get sub's worker list",
        security: [['bearer' => []]],
        tags: ['Worker'],
        parameters: [
            new OA\Parameter(
                name: 'sub',
                description: "Sub's ID",
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'status',
                description: 'Filter workers by status',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                    enum: ['active', 'inactive', 'dead']
                )
            ),
            new OA\Parameter(
                name: 'page',
                description: 'Page number',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'per_page',
                description: 'Items per page (default: 15)',
                in: 'query',
                required: false,
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
                        items: new OA\Items(ref: '#/components/schemas/WorkerResource')
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
class ListController extends Controller
{
    public function __invoke(
        Request $request,
        Sub $sub,
    ): AnonymousResourceCollection {
        return WorkerResource::collection(
            resource: $sub->workers()
                ->byStatus(Status::tryFromInsensitive($request->status)?->value)
                ->paginate($request->per_page ?? 15)
        );
    }
}
