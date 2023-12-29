<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\MinerStat\Upsert;
use App\Dto\MinerStats;
use App\Models\MinerStat;
use App\Services\Api\BtcCom\Client as BtcComClient;
use App\Services\Api\MinerStat\Client as MinerStatsClient;

final readonly class MinerStatService
{
    public static function store(): ?MinerStat
    {
        $imports = app(MinerStatsClient::class)(properties: (new MinerStat)->getFillable());

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
