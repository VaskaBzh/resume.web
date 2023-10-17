<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Dto\WorkerHashRateData;
use App\Models\WorkerHashrate;

class Create
{
    public static function execute(WorkerHashRateData $workerHashRateData): void
    {
        WorkerHashrate::create([
            'worker_id' => $workerHashRateData->workerId,
            'hash' => $workerHashRateData->hash,
            'unit' => $workerHashRateData->unit,
        ]);

        DeleteOldWorkerHashrates::execute(workerHashRateData: $workerHashRateData);
    }
}
