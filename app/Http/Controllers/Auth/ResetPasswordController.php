<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    /**
     * Handle the password change request.
     *
     */
    public function changePassword(Request $request)
    {
        dd($request);
        $validator = Validator::make($request->all(), $this->rules(), $this->customErrorMessages());

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $user = auth()->user();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            if (app()->getLocale() === 'ru') {
                return response()->json(['error' => 'Необходимо подтвердить старый пароль'], Response::HTTP_UNAUTHORIZED);
            } else if (app()->getLocale() === 'en') {
                return response()->json(['error' => 'You need to confirm your old password.'], Response::HTTP_UNAUTHORIZED);
            }
        }

        $this->resetPassword($user, $request->input('password'));

        if (app()->getLocale() === 'ru') {
            return response()->json(['message' => 'Пароль успешно изменен.']);
        } else if (app()->getLocale() === 'en') {
            return response()->json(['message' => 'The password has been successfully changed.']);
        }
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
