<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\Wallet\ChangeAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\ChangeAddressRequest;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class ChangeAddressController extends Controller
{
    #[
        OA\Put(
            path: '/wallets/change/address/{wallet}',
            summary: 'Change wallet address',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                description: 'Request body for update a wallet address',
                required: true,
                content: [
                    new OA\JsonContent(
                        required: [
                            'wallet_address',
                            'confirmation_code',
                        ],
                        properties: [
                            new OA\Property(
                                property: 'wallet_address',
                                type: 'string',
                                maxLength: 191,
                                minLength: 20,
                            ),
                            new OA\Property(
                                property: 'confirmation_code',
                                type: 'numeric',
                                maxLength: 5,
                                minLength: 5,
                            ),
                        ],
                        type: 'object',
                    ),
                ],
            ),
            tags: ['Wallet'],
            parameters: [
                new OA\Parameter(
                    name: 'wallet',
                    description: 'Wallet\'s ID',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_CREATED,
                    description: 'Wallet successfully updated',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    type: 'string',
                                ),
                            ],
                            type: 'object',
                        ),
                    ],
                ),
                new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Wallet not found'),
            ],
        )
    ]
    public function __invoke(ChangeAddressRequest $request, Wallet $wallet): JsonResponse
    {
        $this->authorize('viewOrChange', $wallet);

        ChangeAddress::execute($wallet, $request->wallet_address);

        return new JsonResponse(['message' => __('actions.wallet_update')]);
    }
}
