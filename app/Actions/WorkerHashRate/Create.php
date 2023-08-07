<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Dto\WorkerHashRateData;

class Create
{
    public static function execute(WorkerHashRateData $workerHashRateData): void
    {
        $workerHashRateData
            ->worker
            ->workerHashrates()
            ->create([
                'hash' => $workerHashRateData->hash,
                'unit' => $workerHashRateData->unit,
            ]);
    }
}
