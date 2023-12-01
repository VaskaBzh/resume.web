<?php

namespace App\Console\Commands;

use App\Utils\Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PoolStatCommand extends Command
{
    protected $signature = 'pool:stat';

    protected $description = 'Randomize pool hashrate';

    public function handle(): void
    {
        $poolStats = Storage::disk('public')->get('poolstats.json');

        if ($poolStats = json_decode($poolStats)) {
            if (property_exists($poolStats, 'hashrate')) {
                $regeneratePoolHashRate = Helper::regenerateHashRate($poolStats->hashrate);
                $poolStats->hashrate = $regeneratePoolHashRate;
            }

            Storage::disk('public')->put('poolstats.json', json_encode($poolStats));
        }
    }
}
