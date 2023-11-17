<?php

declare(strict_types=1);

namespace App\Actions\MinerStat;

use App\Models\MinerStat;
use Illuminate\Support\Collection;

class Upsert
{
    public static function execute(Collection $stats): ?MinerStat
    {
        return MinerStat::updateOrCreate(
            ['network_unit' => 'E'],
            array_merge(
                $stats->all(),
                [
                    'next_difficulty' => 0,
                    'change_difficulty' => 0,
                    'time_remain' => 0,
                ]
            ));
    }
}
