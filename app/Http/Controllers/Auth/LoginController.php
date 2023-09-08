<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Config;
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
        if (!Auth::attempt($request->only('email', 'password'))) {
            return new JsonResponse([
                'message' => 'Credentials do not match'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::whereEmail($request->email)->first();
        $token = $user->createToken($user->name);

        return new JsonResponse([
            'user' => $user,
            'token' => $token->plainTextToken,
            'expired_at' => $token->accessToken->expires_at,
            'hash_referral_role' => $user->hasRole('referral')
        ]);
    }

    public function logout(): JsonResponse
    {
        if (auth()->check()) {
            auth()
                ->user()
                ->tokens()
                ->delete();
        }

        return response()->json('Logged out');
    }

    protected function reVerify(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return new JsonResponse([
                'message' => 'Credentials do not match'
            ], Response::HTTP_UNAUTHORIZED);
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
