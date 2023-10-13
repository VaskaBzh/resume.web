<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/workers/{sub}",
 *     summary="Get sub's worker list",
 *     tags={"Worker"},
 *     @OA\Parameter(
 *         name="sub",
 *         in="path",
 *         description="Sub's ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="Filter workers by status (all, active, inactive)",
 *         required=false,
 *         @OA\Schema(type="string", enum={"all", "active", "inactive"})
 *     ),
 *    @OA\Response(
 *          response=200,
 *          description="Successful response",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(
 *                  type="object",
 *                  @OA\Property(property="gid", type="integer"),
 *                  @OA\Property(property="group_name", type="string"),
 *                  @OA\Property(property="worker_id", type="string"),
 *                  @OA\Property(property="worker_name", type="string"),
 *                  @OA\Property(property="is_top", type="boolean"),
 *                  @OA\Property(property="shares_1m", type="string"),
 *                  @OA\Property(property="shares_5m", type="string"),
 *                  @OA\Property(property="shares_15m", type="string"),
 *                  @OA\Property(property="accept_count", type="string"),
 *                  @OA\Property(property="last_share_time", type="integer"),
 *                  @OA\Property(property="last_share_ip", type="string"),
 *                  @OA\Property(property="reject_percent", type="string"),
 *                  @OA\Property(property="first_share_time", type="integer"),
 *                  @OA\Property(property="miner_agent", type="string"),
 *                  @OA\Property(property="shares_unit", type="string"),
 *                  @OA\Property(property="status", type="string"),
 *                  @OA\Property(property="shares_1h", type="integer"),
 *                  @OA\Property(property="shares_1d", type="string"),
 *                  @OA\Property(property="shares_1m_pure", type="string"),
 *                  @OA\Property(property="shares_5m_pure", type="string"),
 *                  @OA\Property(property="shares_15m_pure", type="string"),
 *                  @OA\Property(property="shares_1h_pure", type="integer"),
 *                  @OA\Property(property="shares_1d_pure", type="integer"),
 *                  @OA\Property(property="shares_1d_unit", type="string"),
 *                  @OA\Property(property="reject_percent_1d", type="string"),
 *              )
 *          ),
 *      ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="Sub not found"),
 * )
 */
class ListController extends Controller
{
    public function __invoke(Request $request, Sub $sub, BtcComService $btcComService): JsonResponse
    {
        return new JsonResponse([
            'data' => $btcComService->getWorkerList($sub->group_id, $request->status ?? 'all')
        ]);
    }
}
