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
    /**
     * @OA\Get(
     *     path="/2fac/qrcode/{user}",
     *     summary="Generate QR code for two-factor authentication",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="QR code and secret key generated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="qrCode",
     *                  type="string",
     *                  description="QR code image data"
     *             ),
     *             @OA\Property(
     *                  property="secret",
     *                  type="string",
     *                  description="Secret key for two-factor authentication"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Error message"
     *             ),
     *         ),
     *     ),
     * )
     */
    public function qrCode(User $user, Google2FA $googleTwoFactor): JsonResponse
    {
        try {
            $secretKey = $googleTwoFactor->generateSecretKey();

            $QRImage = $googleTwoFactor->getQRCodeInline(
                config('app.name'),
                $user->email,
                $secretKey
            );

            cache()->put('2fa_secret|' . $user->id, $secretKey, now()->addMinutes(5));
        } catch (\Throwable $e) {
            report($e);

            return new JsonResponse([
                'message' => __('actions.failed')
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'qrCode' => $QRImage,
            'secret' => $secretKey,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/2fac/enable/{user}",
     *     summary="Enable two-factor authentication with secret key",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"two_fa_secret"},
     *             @OA\Property(
     *                  property="two_fa_secret",
     *                  type="string",
     *                  description="Two-factor authentication secret key"
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Two-factor authentication enabled successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Success message"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="error",
     *                  type="string",
     *                  description="Error message"
     *             ),
     *         ),
     *     ),
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/2fac/disable/{user}",
     *     summary="Disable two-factor authentication",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Two-factor authentication disabled successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="status",
     *                  type="boolean",
     *                  description="True if two-factor authentication was successfully disabled, otherwise false"
     *             ),
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Success message"
     *             ),
     *         ),
     *     ),
     * )
     */
    public function disable(User $user): JsonResponse
    {
        return new JsonResponse([
            'status' => $user->update(['google2fa_secret' => null]),
            'message' => __('actions.two_fa_disabled')
        ]);
    }
}
