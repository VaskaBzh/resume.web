<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Worker\Create;
use App\Dto\WorkerData;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;

class SyncWorkerCommand extends Command
{
    protected $signature = 'sync:worker';

    protected $description = 'Command description';

    /**
     * Синхронизация с воркерами
     */
    public function handle(BtcComService $btcComService): void
    {
        $workers = $btcComService->getWorkerList();
        $subs = Sub::all();

        foreach ($subs as $sub) {
            foreach($workers['data'] as $worker) {
                if (head(explode('.', $worker->worker_name)) === $sub->sub) {
                    $workerData = WorkerData::fromRequest($worker);

                    $btcComService->updateWorker(workerData: $workerData);

                    Create::execute(
                        workerData: $workerData
                    );
                }
            }
        }
    }
}
