<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ResendVerifyEmailController extends Controller
{
    use SendsPasswordResetEmails;

    #[
        OA\Post(
            path: '/email/verify/',
            summary: 'Resend email verification link',
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\JsonContent(
                    type: 'object',
                    example: [
                        "email" => "user@example.com",
                    ]
                )
            ),
            tags: ['Auth'],
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
    public function __invoke(Request $request): JsonResponse
    {
        $this->validateEmail($request->email);

        $user = User::whereEmail($request->email)
            ->firstOrFail();

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
