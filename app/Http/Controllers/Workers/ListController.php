<?php

declare(strict_types=1);

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;

class ListController extends Controller
{
    public function __invoke(Sub $sub, BtcComService $btcComService): JsonResponse
    {
        return new JsonResponse([
            'data' => $btcComService->getWorkerList($sub->group_id)
        ]);
    }
}
