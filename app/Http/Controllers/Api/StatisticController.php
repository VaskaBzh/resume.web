<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HashRateResource;
use App\Http\Resources\IncomeCollection;
use App\Models\Hash;
use App\Models\Income;
use App\Models\Sub;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/statistic/{sub}",
 *     summary="Get statistics for a sub",
 *     tags={"Subaccount"},
 *     @OA\Parameter(
 *         name="sub",
 *         in="path",
 *         description="Sub's ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="offset",
 *         in="query",
 *         description="Offset for hash rate data",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="hashes",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/HashRateResource")
 *              ),
 *              @OA\Property(
 *                  property="incomes",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/IncomeCollection")
 *              ),
 *          )
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="Sub not found"),
 * )
 */
class StatisticController extends Controller
{
    public function __invoke(Request $request, Sub $sub): JsonResponse
    {
        return new JsonResponse([
            'hashes' => HashRateResource::collection(
                Hash::getByOffset($sub->group_id, $request->offset)
                    ->select('hash', 'unit', 'worker_count')
                    ->get()
            ),
            'incomes' => new IncomeCollection(
                Income::getByGroupId($sub->group_id)
                    ->selectRaw('daily_amount as amount')
                    ->latest()
                    ->take(30)
                    ->get()
            ),
        ]);
    }
}
