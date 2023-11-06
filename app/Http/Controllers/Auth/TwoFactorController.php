<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoogleTwoFactor\DisableRequest;
use App\Http\Requests\GoogleTwoFactor\EnableRequest;
use App\Models\User;
use App\Traits\HasVerify;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use PragmaRX\Google2FALaravel\Google2FA;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorController extends Controller
{
    use HasVerify;

    #[
        OA\Get(
            path: '/2fac/qrcode/{user}',
            summary: 'Generate QR code for two-factor authentication',
            security: [['bearer' => []]],
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
                                new OA\Property(
                                    property: 'secret',
                                    description: 'secret key',
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
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message']
                                ]
                            ]
                        ),
                    ],
                ),
            ]
        )
    ]
    public function qrCode(User $user, Google2FA $googleTwoFactor): JsonResponse
    {
        try {
            $secretKey = $googleTwoFactor->generateSecretKey();

            $QRImage = $googleTwoFactor->getQRCodeInline(
                company: config('app.name'),
                holder: $user->email,
                secret: $secretKey
            );

        } catch (\Throwable $e) {
            report($e);

            return new JsonResponse([
                'errors' => ['auth' => [__('actions.failed')]]
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'qrCode' => $QRImage,
            'secret' => $secretKey
        ]);
    }


    #[
        OA\Put(
            path: '/2fac/enable/{user}',
            summary: 'Enable two-factor authentication with secret key',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                required: true,
                content: [
                    new OA\JsonContent(
                        required: ['code', 'secret'],
                        properties: [
                            new OA\Property(
                                property: 'code',
                                description: 'Google authenticator code',
                                type: 'string',
                                maxLength: 6,
                                minLength: 6,
                            ),
                            new OA\Property(
                                property: 'secret',
                                description: 'Secret key',
                                type: 'string',
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
                    response: Response::HTTP_OK,
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
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Not found'),
                new OA\Response(
                    response: Response::HTTP_FORBIDDEN,
                    description: 'Bad request',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message']
                                ]
                            ]
                        ),
                    ],
                ),
            ]
        )
    ]
    public function enable(
        EnableRequest $request,
        User          $user,
        Google2FA     $google2FA,
    ): JsonResponse
    {
        $isValid = $google2FA->verifyKey(
            $request->secret,
            $request->code
        );

        if (!$isValid) {

            auth()->guard('web')->logout();

            throw new BusinessException(
                clientMessage: __('auth.two_fa'),
                statusCode: Response::HTTP_FORBIDDEN,
            );
        }

        auth()->user()->update(['google2fa_secret' => $request->secret]);

        return new JsonResponse(['message' => __('actions.two_fa_enabled')]);
    }


    #[
        OA\Put(
            path: '/2fac/disable/{user}',
            summary: 'Disable two-factor authentication',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                required: true,
                content: [
                    new OA\JsonContent(
                        required: ['code', 'secret'],
                        properties: [
                            new OA\Property(
                                property: 'code',
                                description: 'Google authenticator code',
                                type: 'string',
                                maxLength: 6,
                                minLength: 6,
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
                new OA\Response(
                    response: Response::HTTP_NOT_FOUND,
                    description: 'Not found',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message']
                                ]
                            ]
                        ),
                    ],
                ),
            ]
        )
    ]
    public function disable(DisableRequest $request, User $user): JsonResponse
    {
        $this->verifyTwoFa($request->code);

        return new JsonResponse([
            'status' => $user->update(['google2fa_secret' => null]),
            'message' => __('actions.two_fa_disabled')
        ]);
    }
}
