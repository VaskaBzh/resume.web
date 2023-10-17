<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Dto\WorkerHashRateData;
use App\Models\WorkerHashrate;

class DeleteOldWorkerHashrates
{
    public static function execute(WorkerHashRateData $workerHashRateData): void
    {
        WorkerHashrate::oldestThan(
            workerId: $workerHashRateData->workerId,
            date: now()->subMonths(2)->toDateTimeString()
        )?->delete();
    }
}
