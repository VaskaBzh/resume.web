<?php

declare(strict_types=1);

namespace App;

class Helper
{
    /**     *
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
        $btcComFee = 0.5;
        $allBtcFee = 1.5;
        $earnTime = ($difficulty * pow("2", "32")) / (($share * pow("10", "12")) * $secondsPerDay);

        $total = $rewardBlock / $earnTime;
        return $total + $total * (($fppsPercent - $btcComFee - $allBtcFee) / 100);
    }
}
