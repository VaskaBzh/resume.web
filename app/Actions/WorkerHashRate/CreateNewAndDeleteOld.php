<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Models\Worker;
use App\Models\WorkerHashrate;

class CreateNewAndDeleteOld
{
    public static function execute(Worker $worker, array $hashRateData): void
    {
        WorkerHashrate::oldestThan(
            workerId: $worker->worker_id,
            date: now()->subMonths(2)->toDateTimeString()
        )->delete();

        $worker
            ->workerHashrates()
            ->create([
                'worker_id' => $worker->id,
                'hash_per_min' => $hashRateData['hash_rate_per_min'],
                'unit' => $hashRateData['unit'],
            ]);
    }
}
