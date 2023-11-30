<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: '/minerstats',
        summary: 'Get miner statistics',
        tags: ['Miner Stats'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Successful response',
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'minerstats',
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer'),
                                    new OA\Property(property: 'network_hashrate', type: 'string'),
                                    new OA\Property(property: 'network_unit', type: 'string'),
                                    new OA\Property(property: 'network_difficulty', type: 'integer'),
                                    new OA\Property(property: 'next_difficulty', type: 'integer'),
                                    new OA\Property(property: 'change_difficulty', type: 'string'),
                                    new OA\Property(property: 'reward_block', type: 'string'),
                                    new OA\Property(property: 'fpps_rate', type: 'float'),
                                    new OA\Property(property: 'price_USD', type: 'integer'),
                                    new OA\Property(property: 'time_remain', type: 'integer'),
                                    new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
                                    new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
                                ],
                                type: 'object',
                            ),
                        ],
                        type: 'object',
                    ),
                ],
            ),
        ],
    )
]
class MinerStatController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'minerstats' => app('miner_stat'),
        ]);
    }
}
