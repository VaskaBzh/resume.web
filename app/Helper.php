<?php

declare(strict_types=1);

namespace App;

class Helper
{
    /**
     * FPPS settlement income = ∑ (difficulty each time a miner is assigned/the difficulty of the entire network ->
     *  -> when the miner submits computing power each time) * fixed block explosion income (1 + $fppsPercent) *
     * (1 - miner handling fee rate)
     *
     * $earnTime - время добычи блока с заданным хешрейтом ($share * pow(10, 12))
     * @param $share - хешрейт
     * @param $rewardBlock - награда за блок
     * @param $difficulty - сложность сети биткоина
     * @param $fppsPercent - F(доход от транзакционных комиссий) + PPS (вознаграждение за блок)
     */
    public static function calculateEarn(
        $share,
        $rewardBlock,
        $fppsPercent,
        $difficulty
    ): float
    {
        $secondsPerDay = 86400;
        $earnTime = ($difficulty * pow("2", "32")) / (($share * pow("10", "12")) * $secondsPerDay);

        $total = $rewardBlock / $earnTime;
        return $total + $total * (($fppsPercent - 0.5 - 3.5) / 100);
    }
}
