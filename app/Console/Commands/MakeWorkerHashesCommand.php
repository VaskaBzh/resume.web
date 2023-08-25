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
        Worker::all()->each(static function (Worker $worker) use ($btcComService) {

            DeleteOldWorkerHashrates::execute(
                query: WorkerHashrate::oldestThan(
                    workerId: $worker->worker_id,
                    date: now()->subMonths(2)->toDateTimeString()
                )
            );

            try {
                $btcWorker = $btcComService->getWorker($worker->worker_id);

                if ($btcWorker->isNotEmpty()) {
                    WorkerHashrate::create([
                        'worker_id' => $worker->worker_id,
                        'hash' => $btcWorker['shares_1m'] ?? 0,
                        'unit' => $btcWorker['shares_unit'] ?? 'T',
                    ]);

                    Update::execute($worker, workerData: WorkerData::fromRequest([
                        'worker_id' => $worker->worker_id,
                        'group_id' => $worker->group_id,
                        'approximate_hash_rate' => $btcWorker['shares_1d']
                    ]));
                }
            } catch (\Exception $e) {
                report($e);
            }
        });

        $this->call('make:sub-hashes');
    }
}
