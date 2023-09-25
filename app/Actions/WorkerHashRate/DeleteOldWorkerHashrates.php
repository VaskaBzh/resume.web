<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Models\WorkerHashrate;

class DeleteOldWorkerHashrates
{
    public static function execute(int $workerId, string $date): void
    {
        WorkerHashrate::oldestThan(
            workerId: $workerId,
            date: $date
        )->delete();
    }
}
