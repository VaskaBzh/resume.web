<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\External\BtcComService;
use Illuminate\Console\Command;

class SyncWorkerCommand extends Command
{
    protected $signature = 'sync:worker';

    protected $description = 'Command description';

    /**
     * Синхронизация с воркерами btc.com
     */
    public function handle(BtcComService $btcComService): void
    {
        $btcComService->updateLocalWorkers();
        $btcComService->createLocalWorkers();
    }
}
