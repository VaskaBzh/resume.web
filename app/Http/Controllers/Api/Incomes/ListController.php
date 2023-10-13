<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Incomes;

use App\Http\Controllers\Controller;
use App\Http\Resources\IncomeCollection;
use App\Models\Income;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Get(
 *     path="/incomes/{sub}",
 *     summary="Get list of incomes",
 *     tags={"Income list"},
 *     @OA\Parameter(
 *         name="sub",
 *         in="path",
 *         description="Sub's ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="from",
 *         in="query",
 *         description="Start date for filtering incomes",
 *         required=false,
 *         @OA\Schema(type="string", format="date")
 *     ),
 *     @OA\Parameter(
 *         name="to",
 *         in="query",
 *         description="End date for filtering incomes",
 *         required=false,
 *         @OA\Schema(type="string", format="date")
 *     ),
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Number of items per page (default: 15)",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/IncomeCollection")),
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="Sub not found"),
 * )
 */
class ListController extends Controller
{
    public function __invoke(Sub $sub, Request $request): JsonResource
    {
        return new IncomeCollection(
            Income::getByGroupId($sub->group_id)
                ->between('created_at', $request->from, $request->to)
                ->latest()
                ->paginate($request->per_page ?? 15)
        );
    }
}
