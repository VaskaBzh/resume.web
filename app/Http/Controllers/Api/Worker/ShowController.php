<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: '/worker/{worker}',
        summary: 'Get worker details',
        security: [['bearerAuth' => []]],
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
                        properties: [
                            new OA\Property(
                                property: 'data',
                                properties: [
                                    new OA\Property(property: 'worker_id', type: 'string'),
                                    new OA\Property(property: 'worker_name', type: 'string'),
                                    new OA\Property(property: 'shares_1m', type: 'string'),
                                    new OA\Property(property: 'shares_5m', type: 'string'),
                                    new OA\Property(property: 'shares_15m', type: 'string'),
                                    new OA\Property(property: 'accept_count', type: 'integer'),
                                    new OA\Property(property: 'accept_percent', type: 'integer'),
                                    new OA\Property(property: 'reject_percent', type: 'string'),
                                    new OA\Property(property: 'last_share_ip', type: 'string'),
                                    new OA\Property(property: 'ip2location', type: 'string'),
                                    new OA\Property(property: 'last_share_time', type: 'integer'),
                                    new OA\Property(property: 'shares_unit', type: 'string'),
                                    new OA\Property(property: 'worker_status', type: 'string'),
                                    new OA\Property(property: 'shares_1h', type: 'integer'),
                                    new OA\Property(property: 'shares_1d', type: 'string'),
                                    new OA\Property(property: 'shares_1m_pure', type: 'string'),
                                    new OA\Property(property: 'shares_5m_pure', type: 'string'),
                                    new OA\Property(property: 'shares_15m_pure', type: 'string'),
                                    new OA\Property(property: 'shares_1h_pure', type: 'integer'),
                                    new OA\Property(property: 'shares_1d_pure', type: 'integer'),
                                    new OA\Property(property: 'shares_1d_unit', type: 'string'),
                                ],
                                type: 'object'
                            )
                        ],
                        type: 'object'
                    )
                ],
            ),
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: 'Unauthorized',
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: 'Worker not found',
            ),
        ],
    )
]
class ShowController extends Controller
{
    public function __invoke(Worker $worker, BtcComService $btcComService): JsonResponse
    {
        return new JsonResponse([
            'data' => $btcComService->getWorker($worker->worker_id)
        ]);
    }
}
