<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ResendVerifyEmailController extends Controller
{
    #[
        OA\Post(
            path: '/email/verify/{user}',
            summary: 'Resend email verification link',
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
                    description: 'Email verification link sent successfully',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    description: 'Success message',
                                    type: 'string'
                                )
                            ]
                        )
                    ]
                ),
                new OA\Response(
                    response: Response::HTTP_BAD_REQUEST,
                    description: 'Unprocessable Entity',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'errors',
                                    description: 'Validation errors',
                                    type: 'object'
                                )
                            ]
                        )
                    ]
                )
            ]
        )
    ]
    public function __invoke(User $user, Request $request): JsonResponse
    {
        if ($user->hasVerifiedEmail()) {
            return new JsonResponse(['message' => __('auth.email.already_verify', [
                    'value' => $user->email,
                    'date' => $user->email_verified_at
                ], Response::HTTP_BAD_REQUEST)
            ]);
        }

        $user->sendEmailVerificationNotification();

        return new JsonResponse([
            'message' => __('auth.email.verify', [
                'value' => $user->email
            ])]
        );
    }
}
