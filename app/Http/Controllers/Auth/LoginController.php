<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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

    use AuthenticatesUsers;

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return new JsonResponse([
                'error' => [__('auth.failed')]
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::whereEmail($request->email)->first();
        $user->tokens()->delete();

        $token = $user->createToken($user->name, ['*'], now()->addMinutes(config('sanctum.expiration')));

        return new JsonResponse([
            'user' => new UserResource($user),
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
        auth()
            ->user()
            ->tokens()
            ->first()
            ->update(['expires_at' => now()->addHours(2)]);
    }
}
