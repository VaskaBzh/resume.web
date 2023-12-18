<?php

declare(strict_types=1);

namespace App\Actions\MinerStat;

use App\Dto\MinerStats;
use App\Models\MinerStat;

class Upsert
{
    public static function execute(MinerStats $stats): ?MinerStat
    {
        return MinerStat::updateOrCreate(['network_unit' => 'E'], [
            'network_hashrate' => $stats->network_hashrate,
            'network_unit' => $stats->network_unit,
            'network_difficulty' => $stats->network_difficulty,
            'next_difficulty' => $stats->next_difficulty,
            'change_difficulty' => $stats->change_difficulty,
            'reward_block' => $stats->reward_block,
            'fpps_rate' => $stats->fpps_rate,
            'price_USD' => $stats->price_USD,
            'time_remain' => $stats->time_remain,
        ]);
    }
}
