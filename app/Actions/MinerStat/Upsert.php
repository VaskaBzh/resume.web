<?php

declare(strict_types=1);

namespace App\Actions\MinerStat;

use App\Models\MinerStat;

class Upsert
{
    public static function execute(array $stats, int $difficulty): ?MinerStat
    {
        return MinerStat::updateOrCreate(
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
                'fpps_rate' => $stats['more_than_pps96_rate']
            ]);
    }
}
