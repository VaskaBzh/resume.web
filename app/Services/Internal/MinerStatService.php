<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\MinerStat\Upsert;
use App\Models\MinerStat;
use App\Services\External\BtcCom\Client as BtcComClient;
use App\Services\External\MinerStat\Client as MinerStatsClient;

class MinerStatService
{
    public static function store(): ?MinerStat
    {
        $properties = (new MinerStat())->getFillable();

        $stats = collect([
            'time_remain' => 0,
            'network_unit' => 'E',
            'next_difficulty' => 0,
            'change_difficulty' => 0,
            'fpps_rate' => app(BtcComClient::class)->getFppsRate(),
        ]);
        $stats->merge(app(MinerStatsClient::class)(properties: $properties));

        return Upsert::execute($stats);
    }
}
