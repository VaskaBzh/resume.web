<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Worker\Update;
use App\Actions\WorkerHashRate\DeleteOldWorkerHashrates;
use App\Dto\WorkerData;
use App\Models\Worker;
use App\Models\WorkerHashrate;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class MakeWorkerHashesCommand extends Command
{
    protected $signature = 'make:worker-hashes';

    protected $description = 'Command description';

    /**
     * Записываать данные воркера в таблицу хешррейт_воркера
     * старые (храним за два месяца) удалить
     *
     * @return void
     */
    public function handle(BtcComService $btcComService): void
    {
        $btcWorkerList = collect($btcComService->getWorkerList(0));

        $progressBar = $this->output->createProgressBar();

        $progressBar->start();
        $btcWorkerList->each(static function (array $btcComWorker) use ($progressBar) {
            if (array_key_exists('worker_id', $btcComWorker)) {

                $progressBar->advance();

                $localWorker = Worker::where('worker_id', $btcComWorker['worker_id'])
                    ->first();

                if ($localWorker) {
                    DeleteOldWorkerHashrates::execute(
                        workerId: $localWorker->worker_id,
                        date: now()->subMonths(2)->toDateTimeString()
                    );

                    WorkerHashrate::create([
                        'worker_id' => $localWorker->worker_id,
                        'hash' => $btcComWorker['shares_1m'] ?? 0,
                        'unit' => $btcComWorker['shares_unit'] ?? 'T',
                    ]);

                    Update::execute($localWorker, workerData: WorkerData::fromRequest([
                        'worker_id' => $localWorker->worker_id,
                        'group_id' => $localWorker->group_id,
                        'approximate_hash_rate' => $btcComWorker['shares_1d']
                    ]));
                }
            }
        });

        $progressBar->finish();

        Log::channel('commands')->info('WORKER HASHRATE IMPORT COMPLETE: ' . $progressBar->getProgress());

        Artisan::call('make:sub-hashes');
    }
}
