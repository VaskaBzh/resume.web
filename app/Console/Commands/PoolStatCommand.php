<?php

namespace App\Console\Commands;

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
                $regeneratePoolHashRate = self::regenerateHashRate($poolStats->hashrate);
                $poolStats->hashrate = $regeneratePoolHashRate;
            }

            File::put('poolstats.json', json_encode($poolStats));
        }
    }

    /**
     * Generate total pool hash rate for web-statistic dashboards
     */
    public static function regenerateHashRate(int $pureHashRate): int
    {
        $numbers = str_split((string) $pureHashRate);

        $regenerated[] = (int) head($numbers);

        $tail = array_slice($numbers, 2);

        $regenerated[] = mt_rand(0, 5);

        foreach ($tail as $number) {
            $regenerated[] = mt_rand(0, 9);
        }

        return (int) implode('', $regenerated);
    }
}
