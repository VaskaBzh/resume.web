<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkerHashRateResource;
use App\Models\Worker;
use App\Models\WorkerHashrate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Get(
 *     path="/workerhashrate/{worker}",
 *     summary="Get hash rates for a worker",
 *     tags={"Worker"},
 *     @OA\Parameter(
 *         name="worker",
 *         in="path",
 *         description="Worker's ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         description="Limit the number of hash rates to retrieve (default: 24)",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/WorkerHashRateResource")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="Worker not found"),
 * )
 */
class WorkerHashRateController extends Controller
{
    public function __invoke(Request $request, Worker $worker): ResourceCollection
    {
        $workerHahRates = WorkerHashRate::getByOffset($worker->worker_id, $request->limit)->get();

        return WorkerHashRateResource::collection($workerHahRates);
    }
}
