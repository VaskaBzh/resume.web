<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\MinerStat;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/minerstats",
 *     summary="Get miner statistics",
 *     tags={"Miner Stats"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="minerstats", type="object",
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="network_hashrate", type="string"),
 *                 @OA\Property(property="network_unit", type="string"),
 *                 @OA\Property(property="network_difficulty", type="integer"),
 *                 @OA\Property(property="next_difficulty", type="integer"),
 *                 @OA\Property(property="change_difficulty", type="string"),
 *                 @OA\Property(property="reward_block", type="string"),
 *                 @OA\Property(property="fpps_rate", type="float"),
 *                 @OA\Property(property="price_USD", type="integer"),
 *                 @OA\Property(property="time_remain", type="integer"),
 *                 @OA\Property(property="created_at", type="string", format="date-time"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time"),
 *             ),
 *         )
 *     ),
 *     @OA\Response(response=404, description="Not found"),
 * )
 */
class MinerStatController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'minerstats' => MinerStat::first(),
        ]);
    }
}
