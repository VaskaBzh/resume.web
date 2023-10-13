<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubResource;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Get(
 *     path="/subs/sub/{sub}",
 *     summary="Get subaccount",
 *     tags={"Subaccount"},
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
 *         @OA\JsonContent(ref="#/components/schemas/SubResource")
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="User not found"),
 * )
 */
class ShowController extends Controller
{
    public function __invoke(
        Request       $request,
        Sub           $sub,
        BtcComService $btcComService,
    ): JsonResource
    {
        if (!$request->attributes->get('access_key_valid')) {

            $this->authorize('viewOrChange', $sub);
        }

        return new SubResource($btcComService->transformSub($sub));
    }
}
