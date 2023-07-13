<?php

declare(strict_types=1);

namespace App;

class Helper
{
    public static function calculateEarn($share, $rewardBlock, $fppsMminingEarnings, $difficulty): int
    {
        return (
                $share
                * pow(10, 12)
                * 86400
                * ($rewardBlock + $fppsMminingEarnings)
            ) / ($difficulty * pow(2, 32));
    }
}
