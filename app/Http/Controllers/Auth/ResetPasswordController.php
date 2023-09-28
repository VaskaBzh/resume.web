<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

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
        $user = auth()->user();

        $validator = Validator::make($request->all(), $this->rules(), $this->customErrorMessages());

        $confirm = Hash::check($request->input('old_password'), $user->password);

        if (!$validator->validate() || !$confirm) {
            return new JsonResponse(['error' => __('auth.failed')], Response::HTTP_BAD_REQUEST);
        }

        if (!$this->checkIfTokenExpired($user->email)) {
            return new JsonResponse(['message' => 'token not exists or expired']);
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
            'old_password' => ['required'],
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

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        // You may also dispatch an event for password change here, if needed.
    }
}
