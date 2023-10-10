<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorVerifyRequest;
use App\Models\User;
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

    public function enable(User $user): JsonResponse
    {
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
                'secret' => $user->google2fa_secret,
                'message' => __('actions.two_fa_enabled')
            ]);
        } catch (\Exception $e) {
            report($e);

            return new JsonResponse([
                'message' => 'Something went wrong'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function disable(User $user): JsonResponse
    {
        $user->google2fa_secret = null;
        $user->save();

        return new JsonResponse([
            'message' => __('actions.two_fa_disabled')
        ]);
    }
}
