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
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Resource not found'),
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

        try {
            $user = User::whereEmail($request)
                ->firstOrFail();

            if ($user->hasVerifiedEmail()) {
                return new JsonResponse([
                    'errors' => [
                        'auth' => [__('auth.email.already_verify')]
                    ]
                ]);
            }

            $user->sendEmailVerificationNotification();
        } catch (\Throwable) {
            return new JsonResponse([
                'errors' => [
                    'auth' => ['Something went wrong']
                ]
            ]);
        }


        return new JsonResponse([
                'message' => __('auth.email.verify', [
                    'value' => $user->email
                ])]
        );
    }
}
