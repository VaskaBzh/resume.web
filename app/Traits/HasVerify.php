<?php

declare(strict_types=1);

namespace App\Traits;

use App\Exceptions\BusinessException;
use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;

trait HasVerify
{
    public function verifyTwoFa(?string $google2fa_code): void
    {
        if (! $google2fa_code) {

            auth()->guard('web')->logout();

            throw new BusinessException(
                clientMessage: __('auth.two_fa_empty'),
                statusCode: Response::HTTP_FORBIDDEN,
            );
        }

        $isValid = resolve(Google2FA::class)
            ->verifyKey(auth()->user()->google2fa_secret, $google2fa_code);

        if (! $isValid) {

            auth()->guard('web')->logout();

            throw new BusinessException(
                clientMessage: __('auth.two_fa'),
                statusCode: Response::HTTP_FORBIDDEN,
            );
        }
    }

    public function checkEmailVerification(Request $request): void
    {
        if (! $request->user()->hasVerifiedEmail()) {

            auth()->guard('web')->logout();

            throw new BusinessException(
                clientMessage: __('auth.email.not.verified', ['email' => $request->email]),
                statusCode: Response::HTTP_FORBIDDEN,
            );
        }
    }
}
