<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
                description: "Filter workers by status (all, active, inactive)",
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                    enum: ["all", "active", "inactive"]
                )
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
                            properties: [
                                new OA\Property(property: 'gid', type: 'integer'),
                                new OA\Property(property: 'group_name', type: 'string'),
                                new OA\Property(property: 'worker_id', type: 'string'),
                                new OA\Property(property: 'worker_name', type: 'string'),
                                new OA\Property(property: 'is_top', type: 'boolean'),
                                new OA\Property(property: 'shares_1m', type: 'string'),
                                new OA\Property(property: 'shares_5m', type: 'string'),
                                new OA\Property(property: 'shares_15m', type: 'string'),
                                new OA\Property(property: 'accept_count', type: 'string'),
                                new OA\Property(property: 'last_share_time', type: 'integer'),
                                new OA\Property(property: 'last_share_ip', type: 'string'),
                                new OA\Property(property: 'reject_percent', type: 'string'),
                                new OA\Property(property: 'first_share_time', type: 'integer'),
                                new OA\Property(property: 'miner_agent', type: 'string'),
                                new OA\Property(property: 'shares_unit', type: 'string'),
                                new OA\Property(property: 'status', type: 'string'),
                                new OA\Property(property: 'shares_1h', type: 'integer'),
                                new OA\Property(property: 'shares_1d', type: 'string'),
                                new OA\Property(property: 'shares_1m_pure', type: 'string'),
                                new OA\Property(property: 'shares_5m_pure', type: 'string'),
                                new OA\Property(property: 'shares_15m_pure', type: 'string'),
                                new OA\Property(property: 'shares_1h_pure', type: 'integer'),
                                new OA\Property(property: 'shares_1d_pure', type: 'integer'),
                                new OA\Property(property: 'shares_1d_unit', type: 'string'),
                                new OA\Property(property: 'reject_percent_1d', type: 'string'),
                            ]
                        )
                    )
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
                                'property' => ['message']
                            ]
                        ]
                    ),
                ],
            ),
        ],
    )
]
class ListController extends Controller
{
    public function __invoke(Request $request, Sub $sub, BtcComService $btcComService): JsonResponse
    {
        return new JsonResponse([
            'data' => $btcComService->getWorkerList($sub->group_id, $request->status ?? 'all')
        ]);
    }
}
