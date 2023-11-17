<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sub\GeneralSubsDataResource;
use App\Http\Resources\Sub\SubResource;
use App\Models\User;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ListController extends Controller
{
    #[
        OA\Get(
            path: '/subs/{user}',
            summary: 'Get list',
            security: [['bearer' => []]],
            tags: ['Subaccount'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    description: "User's ID",
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
                            properties: [
                                new OA\Property(
                                    property: 'list',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/SubResource'),
                                ),
                                new OA\Property(
                                    property: 'general_subs_data',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/GeneralSubsDataResource')
                                ),
                            ],
                            type: 'object'
                        ),
                    ],
                ),
                new OA\Response(response: 401, description: 'Unauthorized'),
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
    public function __invoke(
        User $user,
        BtcComService $btcComService
    ): JsonResponse {
        $this->authorize('viewAny', $user);

        $subs = $user->subs()
            ->with(['workers'])
            ->get();

        $subCollection = $btcComService->transformSubCollection(subs: $subs);

        return new JsonResponse([
            'list' => SubResource::collection($subCollection),
            'overall' => new GeneralSubsDataResource($subs),
        ]);
    }
}
