<?php

namespace App\Console\Commands;

use App\Services\External\MinerStatService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateMinerStatCommand extends Command
{
    protected $signature = 'update:stats';

    protected $description = 'Command description';

    public function handle(
        MinerStatService $minerStatService,
    ) {
        try {
            $stats = $minerStatService->store();

            if (! is_null($stats)) {
                Log::channel('commands')->info('MINER STATS COMMAND', [
                    'minerstats' => $stats,
                ]);

                $this->info('Stats updated');

                return 0;
            }
        } catch (\Exception $e) {
            report($e);
            $this->error('Stats not imported, check logs');
        }
    }
}
