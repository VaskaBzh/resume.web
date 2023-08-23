<?php

namespace App\Console\Commands;

use App\Actions\MinerStat\Upsert;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateMinerStatCommand extends Command
{
    protected $signature = 'update:stats';

    protected $description = 'Command description';

    public function handle(
        BtcComService $btcComService
    ): void
    {
        $stats = $btcComService->getStats();
        $difficulty = Http::get('https://blockchain.info/q/getdifficulty')
            ->collect()
            ->first();

        if (empty($stats) && !$difficulty) {
            Log::error('Mining stats request is empty');

            return;
        }

        $minerstat = Upsert::execute(stats: $stats, difficulty: $difficulty);

        info('MINER STATS COMMAND', [
            'minerstats' => $minerstat
        ]);

        $this->line('Miner stats created');
    }
}
