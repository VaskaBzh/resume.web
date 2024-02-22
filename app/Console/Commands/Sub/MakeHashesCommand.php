<?php

declare(strict_types=1);

namespace App\Console\Commands\Sub;

use App\Services\SubService;
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

        Log::channel('commands.subs')->info('SUB HASHRATE IMPORT COMPLETE');
    }
}