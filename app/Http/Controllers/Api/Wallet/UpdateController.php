<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Actions\Wallet\Update;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\UpdateRequest;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;


class UpdateController extends Controller
{
    #[
        OA\Put(
            path: '/wallets/update/{wallet}',
            summary: 'Update wallet',
            security: [['bearer' => []]],
            requestBody: new OA\RequestBody(
                description: 'Request body for update a wallet',
                required: true,
                content: [
                    new OA\JsonContent(
                        required: [
                            'wallet_address',
                            'group_id',
                            'confirmation_code',
                        ],
                        properties: array(
                            new OA\Property(
                                property: 'group_id',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                minLength: 3,
                            ),
                        ),
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
    public function __invoke(UpdateRequest $request, Wallet $wallet): JsonResource
    {
        $this->authorize('viewOrChange', $wallet);

        Update::execute(
            walletData: WalletData::fromRequest($request->all()),
            wallet: $wallet,
        );

        return new JsonResource(['message' => trans('actions.wallet_update')]);
    }
}
