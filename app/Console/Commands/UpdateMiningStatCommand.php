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

    public function handle(BtcComService $btcComService): void
    {
        $stats = $btcComService->getPoolData();
        $difficulty = Http::get('https://blockchain.info/q/getdifficulty')
            ->collect()
            ->first();

        $minerstat = MinerStat::create([
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
            info('Miner stats created', $minerstat);
        }

        info('Miner stats not created', [
            'stats' => $stats,
            'difficulty' => $difficulty
        ]);
    }
}
