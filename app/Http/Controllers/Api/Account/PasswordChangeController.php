<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Account;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class PasswordChangeController
{
    #[
        OA\Put(
            path: '/password/change/{user}',
            summary: 'Change user\'s password',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                required: true,
                content: [
                    new OA\JsonContent(ref: '#/components/schemas/ChangePasswordRequest'),
                ]
            ),
            tags: ['Account'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'Password changed successfully',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: ['message' => 'success']
                        ),
                    ]
                ),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'User not found'),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Unprocessable entity',
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
    public function __invoke(ChangePasswordRequest $request, User $user): JsonResponse
    {
        UserService::withUser($user)
            ->changePassword($request->all());

        return new JsonResponse(['message' => __('actions.account.password.update')], Response::HTTP_OK);
    }
}
