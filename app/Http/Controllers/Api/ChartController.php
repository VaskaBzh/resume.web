<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChartResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

/**
 * @OA\Get(
 *     path="/chart",
 *     summary="Get chart data",
 *     tags={"Home page chart"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(ref="#/components/schemas/ChartResource")
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="User not found"),
 * )
 */
class ChartController extends Controller
{
    public function __invoke(): JsonResource
    {
        $response = Http::get('https://api.blockchain.info/charts/difficulty')
            ->collect();

        return new ChartResource($response);
    }
}
