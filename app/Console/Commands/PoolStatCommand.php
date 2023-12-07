<?php

namespace App\Console\Commands;

use App\Utils\Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PoolStatCommand extends Command
{
    protected $signature = 'pool:stat';

    protected $description = 'Randomize pool hashrate';

    public function handle(): void
    {
        if (! File::exists('poolstats.json')) {
            $this->error('File not exists');

            return;
        }

        $poolStats = File::get('poolstats.json');

        if ($poolStats = json_decode($poolStats)) {
            if (property_exists($poolStats, 'hashrate')) {
                $regeneratePoolHashRate = Helper::regenerateHashRate($poolStats->hashrate);
                $poolStats->hashrate = $regeneratePoolHashRate;
            }

            File::put('poolstats.json', json_encode($poolStats));
        }
    }
}
