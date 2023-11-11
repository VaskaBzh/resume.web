<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\User\PasswordChangeConfirmationMail;
use App\Models\User;
use App\Traits\Tokenable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    use Tokenable;

    #[
        OA\Put(
            path: '/password/restore/{user}',
            summary: 'Restore user password',
            requestBody: new OA\RequestBody(
                required: true,
                content: [
                    new OA\JsonContent(
                        required: ['hash', 'password'],
                        properties: [
                            new OA\Property(
                                property: 'hash',
                                description: 'Hash value for email verification',
                                type: 'string'
                            ),
                            new OA\Property(
                                property: 'password',
                                description: "User's new password",
                                type: 'string'
                            ),
                        ]
                    ),
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
                                ),
                            ]
                        ),
                    ]
                ),
                new OA\Response(
                    response: Response::HTTP_FORBIDDEN,
                    description: 'Bad request',
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
    public function restorePassword(Request $request, User $user)
    {
        if (! hash_equals(hash('sha256', $user->getEmailForVerification()), $request->hash)) {

            return new JsonResponse([
                'errors' => [
                    'auth' => [__('auth.email.verify.link.expired')],
                ],
            ], Response::HTTP_FORBIDDEN);
        }

        if ($user->update(['password' => Hash::make($request->password)])) {

            Mail::to($user->email)->send(new PasswordChangeConfirmationMail);

            return new JsonResponse(['message' => 'success']);
        }

        return new JsonResponse([
            'errors' => [
                'auth' => ['Something went wrong'],
            ],
        ], Response::HTTP_BAD_REQUEST);
    }
}
