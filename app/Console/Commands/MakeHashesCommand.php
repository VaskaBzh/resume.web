<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Internal\SubService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MakeHashesCommand extends Command
{
    protected $signature = 'make:sub-hashes';

    protected $description = 'Command description';

    /**
     * Записывать данные хеша
     * старые (период два месяца) удалять
     */
    public function handle(
        SubService $subService
    ): void {
        $subService->createHash();

        Log::channel('commands')->info('SUB HASHRATE IMPORT COMPLETE');
    }
}
