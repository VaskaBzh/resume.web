<?php

declare(strict_types=1);

namespace App\Utils;

class Earn
{
    public static function calculateBitcoin(float $hashRate, float $fee = 0)
    {
        if ($hashRate <= 0) {
            return 0;
        }

        $stats = app('miner_stat')->only('reward_block', 'network_difficulty', 'fpps_rate');

        $secondsPerDay = 86400;

        /*
         * Target difficulty
         */
        $targetDifficulty = $stats['network_difficulty'] * pow(2, 32);

        /**
         * Block earning time based on current hash rate, seconds per day and target
         */
        $earnTime = $targetDifficulty / ($hashRate * $secondsPerDay);

        /**
         * User total earn based on block reward and calculating earning time
         */
        $total = $stats['reward_block'] / $earnTime;

        /**
         * User total earn plus ffps
         */
        $totalWithFpps = $total + ($total * ($stats['fpps_rate'] / 100));

        /**
         * User total with ffps minus tax percent
         */
        return $totalWithFpps - ($totalWithFpps * ($fee / 100));
    }
}
