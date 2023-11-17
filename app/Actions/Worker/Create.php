<?php

declare(strict_types=1);

namespace App\Actions\Worker;

use App\Dto\WorkerData;
use App\Models\Sub;
use App\Models\Worker;

class Create
{
    public static function execute(
        Sub $owner,
        WorkerData $workerData,
    ): Worker {
        $worker = $owner
            ->workers()
            ->create([
                'worker_id' => $workerData->workerId,
                'name' => $workerData->name,
                'status' => $workerData->status,
                'hash_per_day' => $workerData->hashPerDay,
                'unit' => $workerData->unitPerDay,
                'pool_data' => $workerData->poolData,
                'deleted_at' => null,
            ]);

        $worker
            ->workerHashrates()
            ->create([
                'hash_per_min' => $workerData->hashPerMin,
                'unit' => $workerData->unitPerMin,
            ]);

        return $worker;
    }
}
