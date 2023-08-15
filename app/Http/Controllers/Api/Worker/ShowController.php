<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Services\External\BtcComService;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __invoke(Worker $worker, BtcComService $btcComService): JsonResponse
    {
        return new JsonResponse([
            'data' => $btcComService->getWorker($worker->worker_id)
        ]);
    }
}
