<?php

declare(strict_types=1);

namespace App;

class Helper
{
    /**
     * ----
     */
    public static function calculateBalance(float $payment, ?int $percent = 100): float
    {
        return $payment * ($percent / 100);
    }

    public static function sumTotalPayment(float $payments, ?float $payment): ?float
    {
        if (!$payment) {
            return null;
        }

        return $payments + $payment;
    }
}
