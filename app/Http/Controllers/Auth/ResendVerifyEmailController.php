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
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email|exists:users,email'], [
            'email.required' => __('validation.required', ['attribute' => 'email']),
            'email.email' => __('validation.email', ['attribute' => 'email']),
            'email.exists' => __('validation.exists', ['attribute' => 'Email'])
        ]);

        $validator->validate();

        $user = User::whereEmail($request->email)->first();

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
