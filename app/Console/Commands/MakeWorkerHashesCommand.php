<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Worker\Upsert;
use App\Actions\WorkerHashRate\Create as WorkerHashRateCreate;
use App\Dto\WorkerData;
use App\Dto\WorkerHashRateData;
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

                $workerHashrateData = WorkerHashRateData::fromRequest([
                    'worker_id' => (int)$btcComWorker['worker_id'],
                    'hash' => (int)$btcComWorker['shares_1m'],
                    'unit' => $btcComWorker['shares_unit'],
                ]);

                $progressBar->advance();

                WorkerHashRateCreate::execute(workerHashRateData: $workerHashrateData);
            }
        });

        $progressBar->finish();

        Log::channel('commands')->info('WORKER HASHRATE IMPORT COMPLETE: ' . $progressBar->getProgress());

        Artisan::call('make:sub-hashes');
    }
}
