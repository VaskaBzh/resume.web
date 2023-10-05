<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke(Request $request, Sub $sub, BtcComService $btcComService): JsonResponse
    {
        return new JsonResponse([
            'data' => $btcComService->getWorkerList($sub->group_id, $request->status)
        ]);
    }
}
