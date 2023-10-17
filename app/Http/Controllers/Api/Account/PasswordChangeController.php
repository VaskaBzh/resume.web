<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Account;

use App\Mail\User\PasswordChangeConfirmationMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

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
                    new OA\JsonContent(
                        required: ['old_password', 'password', 'password_confirmation'],
                        properties: [
                            new OA\Property(
                                property: 'old_password',
                                description: 'User\'s old password',
                                type: 'string'
                            ),
                            new OA\Property(
                                property: 'password',
                                description: 'User\'s new password',
                                type: 'string'
                            ),
                            new OA\Property(
                                property: 'password_confirmation',
                                description: 'Confirmation of the new password',
                                type: 'string'
                            ),
                        ]
                    )
                ]
            ),
            tags: ['Auth'],
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
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    description: 'Success message',
                                    type: 'string'
                                )
                            ],
                            type: 'object'
                        )
                    ]
                ),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Watcher not found'),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Unprocessable entity',
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
            ]
        )
    ]
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $validator = Validator::make($request->only('old_password', 'password', 'password_confirmation'), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $validator->validate();

        if (Hash::check($request->old_password, $user->password)) {

            $user->update(['password' => Hash::make($request->password)]);
            Mail::to($user->email)->send(new PasswordChangeConfirmationMail);

            return new JsonResponse(['message' => 'success'], Response::HTTP_OK);

        }

        return new JsonResponse([
            'error' => [
                'auth' => [__('auth.failed')]
            ]
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
