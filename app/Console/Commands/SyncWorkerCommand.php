<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Worker\Create as WorkerCreate;
use App\Actions\WorkerHashRate\Create as WorkerHashRateCreate;
use App\Dto\WorkerData;
use App\Dto\WorkerHashRateData;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncWorkerCommand extends Command
{
    protected $signature = 'sync:worker';

    protected $description = 'Command description';

    /**
     * Синхронизация с воркерами
     */
    public function handle(BtcComService $btcComService): void
    {
        $workers = $btcComService->getWorkerList(-1);

        if (!filled($workers)) {

            $this->line('Добавление воркеров не требуется!');

            return;
        }

        $progressBar = $this->output->createProgressBar($workers->count());
        $subs = Sub::all();

        foreach ($subs as $sub) {
            foreach ($workers as $worker) {

                if (head(explode('.', $worker['worker_name'])) === $sub->sub) {

                    $workerData = WorkerData::fromRequest(requestData: [
                        'group_id' => (int)$sub->group_id,
                        'worker_id' => (int)$worker['worker_id'],
                        'approximate_hash_rate' => $worker['shares_1d']
                    ]);

                    try {
                        $btcComService->updateWorker(workerData: $workerData);

                        WorkerCreate::execute(
                            workerData: $workerData
                        );

                        WorkerHashRateCreate::execute(
                            workerHashRateData: WorkerHashRateData::fromRequest([
                                'worker' => $worker,
                                'hash' => (int)$worker['shares_1m'],
                                'unit' => (int)$worker['shares_unit'],
                            ]));

                        $sub->hashes()->firstOrCreate([
                            'group_id' => $sub->group_id,
                            'unit' => (int)$worker['shares_unit'],
                            'hash' => (int)$worker['shares_1m'],
                        ]);

                        $progressBar->advance();
                    } catch (\Exception $e) {
                        report($e);

                        $this->alert($e);
                    }
                }
            }
        }

        $progressBar->finish();
        $this->line("\nДобавление воркеров завершено");

        Log::channel('commands')->info('WORKER IMPORT COMPLETE: ' . $workers->count());
    }
}
