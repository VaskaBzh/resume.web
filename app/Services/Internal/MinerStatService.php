<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\MinerStat\Upsert;
use App\Dto\MinerStats;
use App\Models\MinerStat;
use App\Services\External\BtcCom\Client as BtcComClient;
use App\Services\External\MinerStat\Client as MinerStatsClient;

final readonly class MinerStatService
{
    public static function store(): ?MinerStat
    {
        $properties = (new MinerStat())->getFillable();

        $imports = app(MinerStatsClient::class)(properties: $properties);

        return Upsert::execute(
            stats: MinerStats::fromResponse(collect(
                [
                    'time_remain' => 0,
                    'network_unit' => 'E',
                    'next_difficulty' => 0,
                    'change_difficulty' => 0,
                    'fpps_rate' => app(BtcComClient::class)->getFppsRate(),
                ]
            )->merge($imports))
        );
    }
}
