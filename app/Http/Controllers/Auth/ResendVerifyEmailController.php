<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResendVerifyEmailController extends Controller
{
    /**
     * @OA\Post(
     *     path="/email/verify/{user}",
     *     summary="Resend email verification link",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com", description="User's email address")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Email verification link sent successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Success message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="errors", type="object", description="Validation errors")
     *         )
     *     ),
     * )
     */
    public function __invoke(User $user, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email|exists:users,email'], [
            'email.required' => __('validation.required', ['attribute' => 'email']),
            'email.email' => __('validation.email', ['attribute' => 'email']),
            'email.exists' => __('validation.exists', ['attribute' => 'Email'])
        ]);

        $validator->validate();

        if ($user->hasVerifiedEmail()) {
            return new JsonResponse(['message' => __('auth.email.already_verify', [
                    'value' => $user->email,
                    'date' => $user->email_verified_at
                ])
            ], );
        }

        $user->sendEmailVerificationNotification();

        return new JsonResponse(['message' => __('auth.email.verify', ['value' => $user->email])]);
    }
}
