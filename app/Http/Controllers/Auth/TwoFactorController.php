<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorVerifyRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorController extends Controller
{
    public function __construct(readonly private Google2FA $googleTwoFactor)
    {
    }

    public function enable(): JsonResponse
    {
        $user = auth()->user();
        try {
            $secretKey = $this->googleTwoFactor->generateSecretKey();
            $user->google2fa_secret = $secretKey;
            $user->save();

            $QRImage = $this->googleTwoFactor->getQRCodeInline(
                config('app.name'),
                $user->email,
                $user->google2fa_secret
            );

            return new JsonResponse([
                'qrCode' => $QRImage,
                'secret' => $user->google2fa_secret
            ]);
        } catch (\Exception $e) {
            report($e);

            return new JsonResponse([
                'message' => 'Something went wrong'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function verify(TwoFactorVerifyRequest $request): JsonResponse
    {
        $user = auth()->user();
        try {
            $isValid = $this->googleTwoFactor->verifyKey($user->google2fa_secret, $request->twoFactorSecret);

            if (!$isValid) {
                return new JsonResponse([
                    'error' => 'Не верный код'
                ], 401);
            }
        } catch (\Exception $e) {
            report($e);
        }

        return new JsonResponse([
            'success' => 'Верификация прошла успешно'
        ]);
    }
}
