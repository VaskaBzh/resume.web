<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\External\BtcComService;
use App\Services\Internal\WorkerService;
use Illuminate\Console\Command;

class SyncWorkerCommand extends Command
{
    protected $signature = 'sync:worker';

    protected $description = 'Command description';

    /**
     * Синхронизация с воркерами btc.com
     */
    public function handle(BtcComService $btcComService, WorkerService $workerService): void
    {
        $workerService->sync();
        $btcComService->createLocalWorkers();
    }
}
