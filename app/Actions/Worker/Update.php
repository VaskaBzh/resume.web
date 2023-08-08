<?php

namespace App\Actions\Worker;

use App\Dto\WorkerData;
use App\Models\Worker;

class Update
{
    public static function execute(Worker $worker, WorkerData $workerData): void
    {
        $worker->update([
            'approximate_hash_rate' => $workerData->approximateHashRate
        ]);
    }
}
