<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\WorkerHashRate\DeleteOldWorkerHashrates;
use App\Models\Worker;
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

                Worker::find($btcComWorker['worker_id'])
                    ?->workerHashrates()
                    ->create([
                        'hash' => (int)$btcComWorker['shares_1m'],
                        'unit' => $btcComWorker['shares_unit'],
                    ]);

                DeleteOldWorkerHashrates::execute(workerId: (int) $btcComWorker['worker_id']);

                $progressBar->advance();
            }
        });

        $progressBar->finish();

        Log::channel('commands')->info('WORKER HASHRATE IMPORT COMPLETE: ' . $progressBar->getProgress());

        Artisan::call('make:sub-hashes');
    }
}
