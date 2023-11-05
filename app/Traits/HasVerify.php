<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\Request;
use App\Exceptions\BusinessException;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;

trait HasVerify
{
    public function verifyTwoFa(Request $request): void
    {
        if (!$request->google2fa_code) {
            throw new BusinessException(
                clientMessage: __('auth.two_fa_empty'),
                statusCode: Response::HTTP_FORBIDDEN,
            );
        }
        $isValid = resolve(Google2FA::class)
            ->verifyKey(auth()->user()->google2fa_secret, $request->google2fa_code);

        if (!$isValid) {
            throw new BusinessException(
                clientMessage: __('auth.two_fa'),
                statusCode: Response::HTTP_FORBIDDEN,
            );
        }
    }

    public function checkEmailVerification(Request $request): void
    {
        if (!$request->user()->hasVerifiedEmail()) {
            throw new BusinessException(
                clientMessage: __('auth.email.not.verified', ['email' => $request->user()->email]),
                statusCode: Response::HTTP_FORBIDDEN,
            );
        }
    }
}
