<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Internal\WorkerService;
use Illuminate\Console\Command;

class SyncWorkerCommand extends Command
{
    protected $signature = 'sync:worker';

    protected $description = 'Command description';

    /**
     * Синхронизация с воркерами btc.com
     */
    public function handle(WorkerService $workerService): void
    {
        $workerService->sync(groupId: config('api.btc.all_groups'));
        if (! config('app.local')) {
            $workerService->addNew(groupId: config('api.btc.ungrouped_id'));
        }
    }
}
