<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Worker\Create as WorkerCreate;
use App\Actions\Worker\Upsert;
use App\Actions\WorkerHashRate\Create as WorkerHashRateCreate;
use App\Actions\WorkerHashRate\DeleteOldWorkerHashrates;
use App\Dto\WorkerData;
use App\Dto\WorkerHashRateData;
use App\Models\Sub;
use App\Models\Worker;
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
    public function handle(): void
    {
        $this->add();
        $this->deleteIfNotExists();
    }

    private function add(): void
    {
        $btcComWorkers = resolve(BtcComService::class)->getWorkerList(-1);

        if (!filled($btcComWorkers)) {

            $this->line('Добавление воркеров не требуется!');

            return;
        }

        $progressBar = $this->output->createProgressBar($btcComWorkers->count());

        $btcComWorkers->each(static function (array $worker) use ($progressBar) {
            $subName = head(explode('.', $worker['worker_name']));

            if ($sub = Sub::where('sub', $subName)->first()) {
                try {
                    WorkerHashRateCreate::execute(
                        workerHashRateData: WorkerHashRateData::fromRequest([
                            'worker_id' => (int)$worker['worker_id'],
                            'hash' => (int)$worker['shares_1m'],
                            'unit' => $worker['shares_unit'],
                        ]));
                    Upsert::execute(
                        workerData: $workerData = WorkerData::fromRequest(requestData: [
                            'group_id' => (int)$sub->group_id,
                            'worker_id' => (int)$worker['worker_id'],
                            'approximate_hash_rate' => $worker['shares_1d']
                        ]));

                    resolve(BtcComService::class)->updateWorker(workerData: $workerData);

                    $sub->hashes()->firstOrCreate([
                        'group_id' => (int)$sub->group_id,
                        'hash' => (int)$worker['shares_1m'],
                        'unit' => $worker['shares_unit'],
                    ]);

                    $progressBar->advance();
                } catch (\Exception $e) {
                    report($e);

                    $this->alert($e);
                }
            }
        });

        $progressBar->finish();
        $this->line("\nДобавление воркеров завершено");

        Log::channel('commands')->info('WORKER IMPORT COMPLETE: ' . $btcComWorkers->count());
    }

    private function deleteIfNotExists(): void
    {
        Worker::whereNotIn(
            column: 'worker_id',
            values: resolve(BtcComService::class)
                ->getWorkerList(0)
                ->pluck('worker_id')
                ->toArray()
        )->delete();
    }
}
