<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//

    use AuthenticatesUsers;

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (auth()->check()) {
            return new JsonResponse([
                'error' => ['Already login in']
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return new JsonResponse([
                'error' => ['Credentials do not match']
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::whereEmail($request->email)->first();
        $user->tokens()->delete();

        $token = $user->createToken($user->name, ['*'], now()->addMinutes(config('sanctum.expiration')));

        return new JsonResponse([
            'user' => $user,
            'token' => $token->plainTextToken,
            'expired_at' => $token->accessToken->expires_at,
            'has_referral_role' => $user->hasRole('referral')
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()
            ?->tokens()
            ->delete();

        return response()->json('Logged out');
    }

    public function decreaseTokenTime(): void
    {
        auth()->user()
            ->currentAccessToken()
            ->update(['expires_at' => now()->addHours(2)]);
    }

    public function reVerify(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return new JsonResponse([
                'error' => ['Credentials do not match']
            ], Response::HTTP_BAD_REQUEST);
        }

        User::whereEmail($request->email)
            ->first()
            ->sendEmailVerificationNotification();

        if (app()->getLocale() === 'ru') {
            return response()->json([
                $request->email => [trans('Сообщение с подтверждением отправлено на почту.')],
            ]);
        } else if (app()->getLocale() === 'en') {
            return response()->json([
                $request->email => [trans('A confirmation email has been sent to your email address.')],
            ]);
        }

        return $this->logout();
    }

}
