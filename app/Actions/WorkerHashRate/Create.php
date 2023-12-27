<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Models\Worker;

class Create
{
    public static function execute(Worker $worker, array $hashRateData): void
    {
        $worker
            ->workerHashrates()
            ->create([
                'worker_id' => $worker->id,
                'hash_per_min' => $hashRateData['hash_rate_per_min'],
                'unit' => $hashRateData['unit'],
            ]);
    }
}
