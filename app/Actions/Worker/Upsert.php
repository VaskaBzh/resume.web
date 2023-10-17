<?php

declare(strict_types=1);

namespace App\Actions\Worker;

use App\Dto\WorkerData;
use App\Models\Worker;

class Upsert
{
    public static function execute(
        WorkerData $workerData,
    ): void
    {
        Worker::updateOrCreate([
            'worker_id' => $workerData->worker_id,
            'group_id' => $workerData->group_id,
        ], [
            'approximate_hash_rate' => $workerData->approximateHashRate
        ]);
    }
}
