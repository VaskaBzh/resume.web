<?php

declare(strict_types=1);

namespace App\Console\Commands\Worker;

use App\Models\Worker;
use App\Services\Internal\WorkerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncWorkerCommand extends Command
{
    protected $signature = 'sync:worker';

    protected $description = 'Synchronize local workers with remote';

    /**
     * Синхронизация с воркерами btc.com
     */
    public function handle(WorkerService $workerService): void
    {
        $syncedWorkersCount = $workerService
            ->sync(groupId: config('api.btc.all_groups'), status: 'all')
            ->count();

        $syncedWorkersCount += $workerService
            ->sync(groupId: config('api.btc.all_groups'), status: 'dead')
            ->count();

        if (! config('app.local')) {
            $addedWorkers = $workerService
                ->addNew(groupId: config('api.btc.ungrouped_id'))
                ->count();
        }

        Log::channel('commands.workers')
            ->info(
                message: sprintf("SYNCED COUNT: %s. \n
                ADDED COUNT: %s. \n
                TOTAL 1D HASHRATE: %s",
                    $syncedWorkersCount,
                    $addedWorkers ?? 0,
                    Worker::sum('hash_per_day'),
                )
            );
    }
}
