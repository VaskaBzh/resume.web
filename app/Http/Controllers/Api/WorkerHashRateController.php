<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkerHashRateResource;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkerHashRateController extends Controller
{
    public function __invoke(Request $request, Worker $worker): ResourceCollection
    {
        $workerHahRates = $worker
            ->workerHashrates()
            ->latest()
            ->limit($request->limit)
            ->get();

        return WorkerHashRateResource::collection($workerHahRates);
    }
}
