<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Internal\WorkerService;
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
     */
    public function handle(
        WorkerService $workerService
    ): void {
        $workerService->createHashes(config('api.btc.all_groups'));

        Log::channel('commands')->info('WORKER HASHRATE IMPORT COMPLETE');

        Artisan::call('make:sub-hashes');
    }
}
