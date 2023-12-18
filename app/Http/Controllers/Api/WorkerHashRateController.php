<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Worker\WorkerHashRateResource;
use App\Models\Worker;
use App\Models\WorkerHashrate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: '/workerhashrate/{worker}',
        summary: 'Get hash rates for a worker',
        security: [['bearer' => []]],
        tags: ['Worker'],
        parameters: [
            new OA\Parameter(
                name: 'worker',
                description: "Worker's ID",
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'limit',
                description: 'Limit the number of hash rates to retrieve (default: 24)',
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
                        items: new OA\Items(ref: '#/components/schemas/WorkerHashRateResource')
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
class WorkerHashRateController extends Controller
{
    public function __invoke(Request $request, Worker $worker): ResourceCollection
    {
        $workerHahRates = WorkerHashRate::getByOffset($worker->worker_id, $request->limit)->get();

        return WorkerHashRateResource::collection($workerHahRates);
    }
}
