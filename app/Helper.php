<?php

namespace App;

use App\Models\MinerStat;
use App\Models\User;
use App\Services\External\BtcComService;
use App\Services\Internal\IncomeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Helper
{
    /**
     * Посчитать добычу саб-аккаунта
     *
     * $earnTime - время добычи блока с заданным хешрейтом ($share * pow(10, 12))
     * $this->>hashRate - хешрейт
     * $this->>rewardBlock - награда за блок
     * $this->>network_difficulty - сложность сети биткоина
     * $this->>fpps_rate - F(доход от транзакционных комиссий) + PPS (вознаграждение за блок)
     */
    public static function calculateEarn(MinerStat $stats, float $hashRate, float $allBtcFee = 3.5): float
    {
        if ($hashRate <= 0) {
            return 0;
        }

        $secondsPerDay = 86400;

        $earnTime = ($stats->network_difficulty * pow("2", "32"))
            / (($hashRate * pow("10", "12")) * $secondsPerDay);

        $total = $stats->reward_block / $earnTime;

        return $total + $total * (($stats->fpps_rate - BtcComService::FEE - $allBtcFee) / 100);
    }

    public static function generateUniqReferralCode(): string
    {
        $codeLength = 10;

        $code = Str::random($codeLength);

        if (!User::where('referral_code', $code)->first()) {
            return $code;
        }

        return self::generateUniqReferralCode();
    }
}
