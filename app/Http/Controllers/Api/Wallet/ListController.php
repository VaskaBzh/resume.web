<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use App\Models\Sub;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: '/wallets/{sub}',
        summary: 'Get wallets for a sub',
        security: [['bearerAuth' => []]],
        tags: ['Wallets'],
        parameters: [
            new OA\Parameter(
                name: 'sub',
                description: "Sub's ID",
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Successful response',
                content: [
                    new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            ref: '#/components/schemas/WalletResource'
                        )
                    )
                ],
            ),
            new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Sub not found'),
        ],
    )
]
class ListController extends Controller
{
    public function __invoke(Sub $sub): ResourceCollection
    {
        $this->authorize('viewOrChange', $sub);

        return WalletResource::collection($sub->wallets()->get());
    }
}
