<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HashRateResource;
use App\Http\Resources\IncomeResource;
use App\Models\Hash;
use App\Models\Income;
use App\Models\Sub;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: '/statistic/{sub}',
        summary: 'Get statistics for a sub',
        security: [['bearer' => []]],
        tags: ['Subaccount'],
        parameters: [
            new OA\Parameter(
                name: 'sub',
                description: "Sub's ID",
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'offset',
                description: 'Offset for hash rate data',
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
                        properties: [
                            new OA\Property(
                                property: 'hashes',
                                type: 'array',
                                items: new OA\Items(ref: '#/components/schemas/HashRateResource')
                            ),
                            new OA\Property(
                                property: 'incomes',
                                type: 'array',
                                items: new OA\Items(ref: '#/components/schemas/IncomeResource')
                            ),
                        ],
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
class StatisticController extends Controller
{
    public function __invoke(Request $request, Sub $sub): JsonResponse
    {
        return new JsonResponse([
            'hashes' => HashRateResource::collection(
                Hash::getByOffset($sub->group_id, $request->offset)
                    ->get()
            ),
            'incomes' => IncomeResource::collection(
                Income::getByGroupId($sub->group_id)
                    ->latest()
                    ->take(30)
                    ->get()
            ),
        ]);
    }
}
