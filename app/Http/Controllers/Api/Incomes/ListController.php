<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Incomes;

use App\Http\Controllers\Controller;
use App\Http\Resources\IncomeResource;
use App\Models\Income;
use App\Models\Payout;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ListController extends Controller
{
    #[
        OA\Get(
            path: '/incomes/{sub}',
            summary: 'Get list of incomes',
            security: [['bearer' => []]],
            tags: ['Income'],
            parameters: [
                new OA\Parameter(
                    name: 'sub',
                    description: "Sub's ID",
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
                new OA\Parameter(
                    name: 'from_date',
                    description: 'Start date for filtering incomes',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', format: 'date')
                ),
                new OA\Parameter(
                    name: 'to_date',
                    description: 'End date for filtering incomes',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', format: 'date')
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
                            properties: [
                                new OA\Property(property: 'current_page', type: 'integer'),
                                new OA\Property(
                                    property: 'data',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/IncomeCollection')
                                ),
                                new OA\Property(property: 'first_page_url', type: 'string'),
                                new OA\Property(property: 'from', type: 'integer'),
                                new OA\Property(property: 'last_page', type: 'integer'),
                                new OA\Property(property: 'last_page_url', type: 'string'),
                                new OA\Property(property: 'next_page_url', type: 'string'),
                                new OA\Property(property: 'path', type: 'string'),
                                new OA\Property(property: 'per_page', type: 'integer'),
                                new OA\Property(property: 'prev_page_url', type: 'string'),
                                new OA\Property(property: 'to', type: 'integer'),
                                new OA\Property(property: 'total', type: 'integer'),
                            ],
                            type: 'object'
                        ),
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
                                    'property' => ['message'],
                                ],
                            ]
                        ),
                    ],
                ),
            ]
        )
    ]
    public function __invoke(Sub $sub, Request $request): JsonResource
    {
        return IncomeResource::collection(
            Income::with(['payout.wallet'])
                ->between('incomes.created_at', $request->from, $request->to)
                ->latest('incomes.created_at')
                ->paginate($request->per_page)
        );
    }
}
