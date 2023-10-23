<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = User::whereEmail($request->email)
                ->firstOrFail();

            $request->merge(['user' => $user]);

            if ($user->google2fa_secret) {
                if (!$request->google2fa_code) {
                    return new JsonResponse([
                        'errors' => ['2fa' => ['Pass google2fa_code!']]
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                $isValid = resolve(Google2FA::class)
                    ->verifyKey($user->google2fa_secret, $request->google2fa_code);

                if (!$isValid) {
                    return new JsonResponse([
                        'errors' => ['2fa' => ['Не верный код']]
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                return $next($request);
            }
        } catch (\Throwable) {
            return new JsonResponse([
                'errors' => ['auth' => [__('auth.failed')]]
            ], Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
