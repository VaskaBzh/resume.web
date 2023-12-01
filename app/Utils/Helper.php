<?php

declare(strict_types=1);

namespace App\Utils;

use App\Models\MinerStat;

class Helper
{
    /**
     * Посчитать добычу саб-аккаунта
     *
     * $earnTime - время добычи блока с заданным хешрейтом ($hashRate)
     * $hashRate - хешрейт в хешах в секунду (H/s)
     * $this->rewardBlock - награда за блок
     * $this->network_difficulty - сложность сети биткоина
     * $this->fpps_rate - F(доход от транзакционных комиссий) + PPS (вознаграждение за блок)
     */
    public static function calculateEarn(MinerStat $stats, float $hashRate, float $fee = 0): float
    {
        if ($hashRate <= 0) {
            return 0;
        }

        $secondsPerDay = 86400;

        /*
         * Target difficulty
         */
        $targetDifficulty = $stats->network_difficulty * pow(2, 32);

        /**
         * Block earning time based on current hash rate, seconds per day and target
         */
        $earnTime = $targetDifficulty / ($hashRate * $secondsPerDay);

        /**
         * User total earn based on block reward and calculating earning time
         */
        $total = $stats->reward_block / $earnTime;

        /**
         * User total earn plus ffps
         */
        $totalWithFpps = $total + ($total * ($stats->fpps_rate / 100));

        /**
         * User total with ffps minus tax percent
         */
        return $totalWithFpps - ($totalWithFpps * ($fee / 100));
    }

    public static function regenerateHashRate(int $pureHashRate): int
    {
        $numbers = str_split((string) $pureHashRate);

        $regenerated[] = (int) head($numbers);

        $tail = array_slice($numbers, 4);

        $regenerated[] = mt_rand(5, 9);
        $regenerated[] = mt_rand(5, 8);
        $regenerated[] = mt_rand(4, 9);

        foreach ($tail as $number) {
            $regenerated[] = mt_rand(0, 9);
        }

        return (int) implode('', $regenerated);
    }
}
