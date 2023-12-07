<?php

declare(strict_types=1);

namespace App\Actions\MinerStat;

use App\Models\MinerStat;
use Illuminate\Support\Collection;

class Upsert
{
    public static function execute(Collection $stats): ?MinerStat
    {
        return MinerStat::updateOrCreate(['id' => 1], $stats->all());
    }
}
