<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkerHashRateResource;
use App\Models\Worker;
use App\Models\WorkerHashrate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkerHashRateController extends Controller
{
    public function __invoke(Request $request, Worker $worker): ResourceCollection
    {
        $workerHahRates = WorkerHashRate::getByOffset($worker->worker_id, $request->limit)->get();

        return WorkerHashRateResource::collection($workerHahRates);
    }
}
