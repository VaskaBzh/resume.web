<?php

declare(strict_types=1);

namespace App\Console\Commands\Worker;

use App\Services\Internal\WorkerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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

        Artisan::call('make:sub-hashes');
    }
}
