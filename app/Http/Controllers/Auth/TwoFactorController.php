<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorVerifyRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorController extends Controller
{
    public function qrCode(User $user, Google2FA $googleTwoFactor): JsonResponse
    {
        try {
            $secretKey = $googleTwoFactor->generateSecretKey();

            $QRImage = $googleTwoFactor->getQRCodeInline(
                config('app.name'),
                $user->email,
                $secretKey
            );

            cache()->put('2fa_secret|' . $user->id, $secretKey, now()->addMinutes(30));
        } catch (\Throwable $e) {
            report($e);

            return new JsonResponse([
                'message' => __('actions.failed')
            ]);
        }

        return new JsonResponse([
            'qrCode' => $QRImage,
            'secret' => $secretKey,
        ]);
    }

    public function enable(
        TwoFactorVerifyRequest $request,
        User $user,
        Google2FA $googleTwoFactor,
    ): JsonResponse
    {

        try {
            $secretKey = cache()->get('2fa_secret|' . $user->id);

            $isValid = $googleTwoFactor->verifyKey($secretKey, $request->two_fa_secret);

            if (!$isValid) {
                return new JsonResponse([
                    'error' => 'Не верный код'
                ], Response::HTTP_BAD_REQUEST);
            }

            $user->update(['google2fa_secret' => $secretKey]);

            cache()->forget('2fa_secret|' . $user->id);

            return new JsonResponse(['message' => __('actions.two_fa_enabled')]);
        } catch (\Throwable $e) {
            report($e);

            return new JsonResponse([
                'message' => 'Something went wrong'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function disable(User $user): JsonResponse
    {
        return new JsonResponse([
            'status' => $user->update(['google2fa_secret' => null]),
            'message' => __('actions.two_fa_disabled')
        ]);
    }
}
