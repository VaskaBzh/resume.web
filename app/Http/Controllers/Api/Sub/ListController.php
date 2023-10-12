<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubResource;
use App\Models\User;
use App\Services\External\BtcComService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListController extends Controller
{
    /**
     * @OA\Get(
     *     path="/subs/{user}",
     *     summary="Get subaccount list for a user",
     *     tags={"Subaccounts"},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User's ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/SubResource")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="User not found"),
     * )
     */
    public function __invoke(User $user, BtcComService $btcComService): ResourceCollection
    {
        $this->authorize('viewAny', $user);

        $subCollection = $btcComService->transformSubCollection(subs: $user->subs()->get());

        return SubResource::collection($subCollection);
    }
}
