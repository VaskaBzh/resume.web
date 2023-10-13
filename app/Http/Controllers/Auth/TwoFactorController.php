<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorVerifyRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class TwoFactorController extends Controller
{
    #[
        OA\Get(
            path: '/2fac/qrcode/{user}',
            summary: 'Generate QR code for two-factor authentication',
            security: [['bearerAuth' => []]],
            tags: ['Auth'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'QR code and secret key generated successfully',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'qrCode',
                                    description: 'QR code image data',
                                    type: 'string'
                                ),
                            ]
                        )
                    ]
                ),
                new OA\Response(
                    response: Response::HTTP_BAD_REQUEST,
                    description: 'Bad request',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    description: 'Error message',
                                    type: 'string'
                                ),
                            ]
                        )
                    ]
                ),
            ]
        )
    ]
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
        ]);
    }


    #[
        OA\Put(
            path: '/2fac/enable/{user}',
            summary: 'Enable two-factor authentication with secret key',
            security: [['bearerAuth' => []]],
            requestBody: new OA\RequestBody(
                required: true,
                content: [
                    new OA\JsonContent(
                        required: ['two_fa_secret'],
                        properties: [
                            new OA\Property(
                                property: 'two_fa_secret',
                                description: 'Two-factor authentication secret key',
                                type: 'string'
                            ),
                        ]
                    )
                ]
            ),
            tags: ['Auth'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_ACCEPTED,
                    description: 'Two-factor authentication enabled successfully',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    description: 'Success message',
                                    type: 'string'
                                ),
                            ]
                        )
                    ]
                ),
                new OA\Response(
                    response: Response::HTTP_BAD_REQUEST,
                    description: 'Bad request',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'error',
                                    description: 'Error message',
                                    type: 'string'
                                ),
                            ]
                        )
                    ]
                ),
            ]
        )
    ]
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


    #[
        OA\Put(
            path: '/2fac/disable/{user}',
            summary: 'Disable two-factor authentication',
            security: [['bearerAuth' => []]],
            tags: ['Auth'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_ACCEPTED,
                    description: 'Two-factor authentication disabled successfully',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'status',
                                    description: 'True if two-factor authentication was successfully disabled, otherwise false',
                                    type: 'boolean'
                                ),
                                new OA\Property(
                                    property: 'message',
                                    description: 'Success message',
                                    type: 'string'
                                ),
                            ]
                        )
                    ]
                ),
            ]
        )
    ]
    public function disable(User $user): JsonResponse
    {
        return new JsonResponse([
            'status' => $user->update(['google2fa_secret' => null]),
            'message' => __('actions.two_fa_disabled')
        ]);
    }
}
