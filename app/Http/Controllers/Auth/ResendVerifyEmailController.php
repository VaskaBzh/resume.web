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
                            type: 'object',
                            example: [
                                'message' => [
                                    'email' => 'string'
                                ]
                            ]
                        ),
                    ],
                ),
                new OA\Response(response: Response::HTTP_BAD_REQUEST, description: 'Resource not found'),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Validation error',
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
                )
            ]
        )
    ]
    public function __invoke(Request $request): JsonResponse
    {
        $this->validateEmail($request);

        $user = User::whereEmail($request->email)
            ->firstOrFail();

        if ($user->hasVerifiedEmail()) {
            return new JsonResponse([
                'errors' => [
                    'auth' => [__('auth.email.already_verify', ['value' => 'email', 'date' => $user->email_verified_at])]
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        $user->sendEmailVerificationNotification();

        return new JsonResponse([
                'message' => __('auth.email.verify', [
                    'value' => $user->email
                ])]
        );
    }
}
