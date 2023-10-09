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
        $user = User::whereEmail($request->email)
            ->firstOrFail();

        $request->merge(['user' => $user]);

        if ($user->google2fa_secret) {
            if (!$request->two_fa_secret) {
                return new JsonResponse([
                    'error' => 'Pass two_fa_secret!'
                ], Response::HTTP_BAD_REQUEST);
            }
            try {
                $isValid = resolve(Google2FA::class)
                    ->verifyKey($user->google2fa_secret, $request->two_fa_secret);

                if (!$isValid) {
                    return new JsonResponse([
                        'error' => 'Не верный код'
                    ], Response::HTTP_BAD_REQUEST);
                }

                return $next($request);

            } catch (\Exception $e) {
                report($e);

                return new JsonResponse([
                    'error' => __('auth.failed')
                ], Response::HTTP_BAD_REQUEST);
            }
        }

        return $next($request);
    }
}
