<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Tokenable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    use Tokenable;

    public function sendEmail(): JsonResponse
    {
        $user = auth()->user();

        if ($user->hasVerifiedEmail()) {

            $user->sendPasswordResetNotification(Password::createToken($user));

            return new JsonResponse(['message' => 'success']);
        }

        return new JsonResponse(['message' => 'user email not verified'], Response::HTTP_FORBIDDEN);
    }

    public function changePassword(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        $validator = Validator::make($request->all(), $this->rules(), $this->customErrorMessages());

        if (!$validator->validate()) {
            return new JsonResponse(['error' => __('auth.failed')], Response::HTTP_BAD_REQUEST);
        }

        if (!$this->checkIfTokenExpired($user->email)) {
            return new JsonResponse(['message' => 'token not exists or expired'], Response::HTTP_BAD_REQUEST);
        }

        if ($user->update(['password' => Hash::make($request->password)])) {

            $this->deleteToken($user);

            return new JsonResponse(['message' => 'success']);

        }

        return new JsonResponse(['message' => 'Something went wrong'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Get the password change validation rules.
     *
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Get the custom error messages.
     *
     * @return array
     */
    protected function customErrorMessages()
    {
        if (app()->getLocale() === 'ru') {
            return [
                'old_password.required' => 'Введите старый пароль',
                'password.required' => 'Введите новый пароль',
                'password.confirmed' => 'Подтвердите пароль',
                'password.min' => 'Новый пароль должен содержать минимум 8 символов.',
            ];
        } else if (app()->getLocale() === 'en') {
            return [
                'old_password.required' => 'Enter the old password.',
                'password.required' => 'Enter the new password.',
                'password.confirmed' => 'Confirm the password.',
                'password.min' => 'The new password must be at least 8 characters.',
            ];
        }
    }
}
