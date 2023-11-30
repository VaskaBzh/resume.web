<?php

declare(strict_types=1);

namespace App\Actions\Worker;

use App\Dto\WorkerData;
use App\Models\Worker;

class Update
{
    public static function execute(WorkerData $workerData): void
    {
        Worker::withTrashed()->updateOrCreate(['worker_id' => $workerData->workerId], [
            'worker_id' => $workerData->workerId,
            'group_id' => $workerData->groupId,
            'name' => $workerData->name,
            'hash_per_day' => $workerData->hashPerDay,
            'status' => $workerData->status,
            'unit' => $workerData->unitPerDay,
            'pool_data' => $workerData->poolData,
        ]);
    }
}
