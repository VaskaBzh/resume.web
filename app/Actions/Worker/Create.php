<?php

declare(strict_types=1);

namespace App\Actions\Worker;

use App\Dto\WorkerData;
use App\Models\Worker;

class Create
{
    public static function execute(WorkerData $workerData): void
    {
        Worker::create([
            'group_id' => $workerData->group_id,
            'worker_id' => $workerData->worker_id
        ]);
    }
}
