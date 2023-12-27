<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCreateRequest;
use App\Models\User;
use App\Services\SubService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends Controller
{
    #[
        OA\Post(
            path: '/subs/create/{user}',
            summary: 'Create a sub',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                description: 'Request body for creating a sub',
                required: true,
                content: [
                    new OA\JsonContent(
                        required: ['name'],
                        properties: [
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                maxLength: 255,
                                minLength: 3
                            ),
                        ],
                        type: 'object',
                    ),
                ],
            ),
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
                    response: Response::HTTP_CREATED,
                    description: 'Sub created successfully',
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
                new OA\Response(response: Response::HTTP_BAD_REQUEST, description: 'Already exist'),
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
    public function __invoke(
        SubCreateRequest $request,
        User $user,
        SubService $subService,
    ): JsonResponse {
        try {
            $remoteSub = $subService->createRemoteSub($request->name);
            $subService->createLocalSub($user, $remoteSub);

            return new JsonResponse([
                'message' => __('actions.success_sub_create'),
            ], Response::HTTP_CREATED);
        } catch (BusinessException $e) {
            return new JsonResponse([
                'errors' => [
                    'name' => [$e->getClientMessage()],
                ],
            ], $e->getClientStatusCode());
        }
    }
}
