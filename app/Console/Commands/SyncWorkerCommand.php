<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Worker\Create;
use App\Dto\WorkerData;
use App\Models\Finance;
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

        if (!filled($workers)) {

            $this->line('Все воркеры сгруппированны!');

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
                    ]);

                    try {
                        $btcComService->updateWorker(workerData: $workerData);

                        Create::execute(
                            workerData: $workerData
                        );

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
    }
}
