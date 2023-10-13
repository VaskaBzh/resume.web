<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/worker/{worker}",
 *     summary="Get worker details",
 *     tags={"Worker"},
 *     @OA\Parameter(
 *         name="worker",
 *         in="path",
 *         description="Worker's ID",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="worker_id", type="string"),
 *                 @OA\Property(property="worker_name", type="string"),
 *                 @OA\Property(property="shares_1m", type="string"),
 *                 @OA\Property(property="shares_5m", type="string"),
 *                 @OA\Property(property="shares_15m", type="string"),
 *                 @OA\Property(property="accept_count", type="integer"),
 *                 @OA\Property(property="accept_percent", type="integer"),
 *                 @OA\Property(property="reject_percent", type="string"),
 *                 @OA\Property(property="last_share_ip", type="string"),
 *                 @OA\Property(property="ip2location", type="string"),
 *                 @OA\Property(property="last_share_time", type="integer"),
 *                 @OA\Property(property="shares_unit", type="string"),
 *                 @OA\Property(property="worker_status", type="string"),
 *                 @OA\Property(property="shares_1h", type="integer"),
 *                 @OA\Property(property="shares_1d", type="string"),
 *                 @OA\Property(property="shares_1m_pure", type="string"),
 *                 @OA\Property(property="shares_5m_pure", type="string"),
 *                 @OA\Property(property="shares_15m_pure", type="string"),
 *                 @OA\Property(property="shares_1h_pure", type="integer"),
 *                 @OA\Property(property="shares_1d_pure", type="integer"),
 *                 @OA\Property(property="shares_1d_unit", type="string"),
 *             )
 *         ),
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="Worker not found"),
 * )
 */
class ShowController extends Controller
{
    public function __invoke(Worker $worker, BtcComService $btcComService): JsonResponse
    {
        return new JsonResponse([
            'data' => $btcComService->getWorker($worker->worker_id)
        ]);
    }
}
