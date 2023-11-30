<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\Wallet\Create;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\CreateRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends Controller
{
    #[
        OA\Post(
            path: '/wallets/create',
            summary: 'Create a wallet',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                description: 'Request body for creating a wallet',
                required: true,
                content: [
                    new OA\JsonContent(
                        required: [
                            'wallet_address',
                            'group_id',
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
                                property: 'group_id',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                minLength: 3,
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
            responses: [
                new OA\Response(
                    response: Response::HTTP_CREATED,
                    description: 'Wallet created successfully',
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
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Validation errors',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message'],
                                ],
                            ]
                        ),
                    ],
                ),
            ],
        )
    ]
    public function __invoke(CreateRequest $request): JsonResource
    {
        Create::execute(
            walletData: WalletData::fromRequest($request->all())
        );

        return new JsonResource(['message' => trans('actions.wallet_create')]);
    }
}
