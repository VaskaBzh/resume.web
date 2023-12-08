<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\External\MinerStatService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateMinerStatCommand extends Command
{
    protected $signature = 'update:stats';

    protected $description = 'Command description';

    public function handle(): void
    {
        try {
            $stats = MinerStatService::store();

            if (! is_null($stats)) {
                Log::channel('commands.blockchain')->info('MINER STATS COMMAND', [
                    'minerstats' => $stats,
                ]);

                $this->info('Stats updated');
            }
        } catch (\Exception $e) {
            report($e);
            $this->error('Stats not imported, check logs');
        }

        $this->call('pool:stat');
    }
}
