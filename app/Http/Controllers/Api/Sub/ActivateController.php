<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Actions\Sub\Activate;
use App\Http\Controllers\Controller;
use App\Models\Sub;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ActivateController extends Controller
{
    #[
        OA\Put(
            path: '/subs/sub/activate/{sub}',
            description: 'Referrer role required for this action',
            summary: 'Mark sub as active',
            security: [['bearer' => []]],
            tags: ['Subaccount'],
            parameters: [
                new OA\Parameter(
                    name: 'Sub',
                    description: "Sub's group_id",
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_CREATED,
                    description: 'Sub activated successfully',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    type: 'string',
                                ),
                            ],
                            type: 'object',
                        ),
                    ],
                ),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Not found'),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Validation errors',
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
    public function __invoke(Sub $sub): JsonResponse
    {
        $this->authorize('viewOrChange', $sub);
        $this->authorize('activate', $sub);

        Activate::execute(sub: $sub);

        return new JsonResponse(['message' => 'success']);
    }
}
