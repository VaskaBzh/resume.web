<?php

namespace App\Console\Commands;

use App\Actions\MinerStat\Upsert;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateMinerStatCommand extends Command
{
    protected $signature = 'update:stats';

    protected $description = 'Command description';

    public function handle(): void
    {
        $stats = Http::get('https://pool.api.btc.com/v1/pool/status')
            ->collect()['data'];
        $difficulty = Http::get('https://blockchain.info/q/getdifficulty')
            ->collect()
            ->first();

        if (empty($stats) && !$difficulty) {
            Log::error('Mining stats request is empty');

            return;
        }

        $minerstat = Upsert::execute(stats: $stats, difficulty: $difficulty);

        info('Miner stats created', [
            'minerstats' => $minerstat
        ]);

        $this->line('Miner stats created');
    }
}
