<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Models\WorkerHashrate;

class DeleteOldWorkerHashrates
{
    public static function execute(int $workerId): void
    {
        WorkerHashrate::oldestThan(
            workerId: $workerId,
            date: now()->subMonths(2)->toDateTimeString()
        )->delete();
    }
}
