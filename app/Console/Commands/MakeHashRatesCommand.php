<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\WorkerHashRate\BulkDelete;
use App\Models\Worker;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;

class MakeHashRatesCommand extends Command
{
    protected $signature = 'make:hash-rates';

    protected $description = 'Command description';

    /**
     * Записываать данные воркера в таблицу хешррейт_воркера
     *
     * старые (храним за два месяца) удалить
     *
     *
     * @return void
     */
    public function handle(BtcComService $btcComService): void
    {
        Worker::all()->each(static function (Worker $worker) use ($btcComService) {
            $hashRates = $worker->oldestHashRatesThan(
                date: now()->subMonths(2)->toDateTimeString()
            )->get();

            if ($hashRates->isNotEmpty()) {
                BulkDelete::execute($hashRates);
            }

            try {
                $btcWorkers = $btcComService->getWorkerList($worker->group_id);

                if (filled($btcWorkers)) {
                    $btcWorker = $btcWorkers->firstWhere('worker_id', $worker->worker_id);

                    $worker->worker_hashrates()->create([
                        'worker_id' => $worker->worker_id,
                        'hash' => $btcWorker->shares_1m ?? 0,
                        'unit' => $item->shares_unit ?? 'T',
                    ]);
                }


            } catch (\Exception $e) {
                report($e);
            }
        });
    }
}
