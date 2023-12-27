<?php

namespace App\Console\Commands;

use App\Actions\Hashes\DeleteOld as DeleteOldSubHash;
use App\Actions\WorkerHashRate\DeleteOld as DeleteOldWorkerHash;
use Illuminate\Console\Command;

class DeleteHashCommand extends Command
{
    protected $signature = 'delete:hash';

    protected $description = 'Command description';

    public function handle(): void
    {
        DeleteOldSubHash::execute();
        DeleteOldWorkerHash::execute();
    }
}
