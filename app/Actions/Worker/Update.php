<?php

namespace App\Actions\Worker;

use App\Dto\WorkerData;
use App\Models\Worker;

class Update
{
    public static function execute(WorkerData $workerData): void
    {
        Worker::update(
            [
                'worker_id' => $workerData->worker_id,
                'group_id' => $workerData->group_id
            ],
            [
                'approximate_hash_rate' => $workerData->approximateHashRate
            ]
        );
    }
}
