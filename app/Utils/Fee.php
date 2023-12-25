<?php

declare(strict_types=1);

namespace App\Utils;

use App\Exceptions\CalculatingException;
use App\Models\Sub;

class Fee
{
    public static function get(Sub $sub): float
    {
        $fee = $sub->allbtc_fee - (float) $sub->user->referral_discount;

        if ($fee < 0) {
            throw new CalculatingException('Fee should not be unsigned');
        }

        return $fee;
    }
}
