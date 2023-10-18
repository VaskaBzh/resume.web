<?php

namespace App\Actions\Worker;

use App\Dto\WorkerData;
use App\Models\Worker;

class Update
{
    public static function execute(WorkerData $workerData): void
    {
        Worker::where('worker_id', $workerData->worker_id)
            ->withTrashed()
            ->update([
                'name' => $workerData->name,
                'approximate_hash_rate' => $workerData->approximateHashRate,
                'status' => $workerData->status,
                'unit' => $workerData->unit,
                'pool_data' => $workerData->poolData,
                'deleted_at' => null,
            ]);
    }
}
