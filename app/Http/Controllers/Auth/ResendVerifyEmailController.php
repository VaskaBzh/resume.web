<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ResendVerifyEmailController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = auth()->user();

        if ($user->hasVerifiedEmail()) {
            return new JsonResponse(['message' => __('auth.email.already_verify', [
                    'value' => $user->email,
                    'date' => $user->email_verified_at
                ])
            ]);
        }

        $user->sendEmailVerificationNotification();

        return new JsonResponse(['message' => __('auth.email.verify', ['value' => $user->email])]);
    }
}
