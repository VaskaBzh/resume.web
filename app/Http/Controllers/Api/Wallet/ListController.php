<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Get(
 *     path="/wallets/{sub}",
 *     summary="Get wallets for a sub",
 *     tags={"Wallets"},
 *     @OA\Parameter(
 *         name="sub",
 *         in="path",
 *         description="Sub's ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/WalletResource"),
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="Sub not found"),
 * )
 */
class ListController extends Controller
{
    public function __invoke(Sub $sub): ResourceCollection
    {
        $this->authorize('viewOrChange', $sub);

        return WalletResource::collection($sub->wallets()->get());
    }
}
