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

class TwoFactorController extends Controller
{
    public function __construct(readonly private Google2FA $googleTwoFactor)
    {}

    public function enable(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if ($request->has('2fac')) {
            try {
                $secretKey = $this->googleTwoFactor->generateSecretKey();
                $user->google2fa_secret = $secretKey;
                $user->save();

                $QRImage = $this->googleTwoFactor->getQRCodeInline(
                    'test',
                    $user->email,
                    $user->google2fa_secret
                );
            } catch (\Exception $e) {
                report($e);
            }

            return redirect()->route('2fa.show')->with([
                'qrCode' => $QRImage,
                'secret' => $user->google2fa_secret
            ]);
        }

        return back();
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
            'success' => 'Авторизация прошла успешно'
        ]);
    }
}
