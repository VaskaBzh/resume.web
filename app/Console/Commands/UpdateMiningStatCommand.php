<?php

namespace App\Console\Commands;

use App\Models\MinerStat;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateMiningStatCommand extends Command
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

        $minerstat = MinerStat::updateOrCreate(
            ['network_unit' => 'E'],
            [
            'network_hashrate' => $stats['network_hashrate'],
            'network_unit' => $stats['network_hashrate_unit'],
            'network_difficulty' => $difficulty,
            'next_difficulty' => $stats['estimated_next_difficulty'],
            'change_difficulty' => $stats['difficulty_change'],
            'reward_block' => MinerStat::REWARD_BLOCK,
            'price_USD' => $stats['exchange_rate']['BTC2USD'],
            'time_remain' => $stats['time_remain'] * 1000,
        ]);

        if ($minerstat) {
            info('Miner stats created', [
                'minerstats' => $minerstat
            ]);
        }

        info('Miner stats not created', [
            'stats' => $stats,
            'difficulty' => $difficulty
        ]);
    }
}
