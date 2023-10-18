<?php

declare(strict_types=1);

namespace App\Actions\Worker;

use App\Dto\WorkerData;
use App\Models\Worker;

class Create
{
    public static function execute(
        WorkerData $workerData,
    ): void
    {
        Worker::create([
            'worker_id' => $workerData->worker_id,
            'group_id' => $workerData->group_id,
            'name' => $workerData->name,
            'approximate_hash_rate' => $workerData->approximateHashRate,
            'status' => $workerData->status,
            'unit' => $workerData->unit,
            'pool_data' => $workerData->poolData,
            'deleted_at' => null,
        ]);
    }
}
