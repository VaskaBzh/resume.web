<?php

declare(strict_types=1);

namespace App\Enums\Income;

use App\Models\Sub;

enum Status: string
{
    case PENDING = 'pending';
    case NO_WALLET = 'wallet needed';
    case ON_VERIFY = 'verification';
    case READY_TO_PAYOUT = 'ready to payout';
    case COMPLETED = 'completed';
    case ERROR = 'error';

    public static function onSub(Sub $sub, float $amount): Status
    {
        return match (true) {
            $sub->wallets->isEmpty() => self::NO_WALLET,
            ! $sub->wallets->first()->isUnlocked() => self::ON_VERIFY,
            ! $sub->isAmountLimitReached($amount) => self::PENDING,
            default => self::READY_TO_PAYOUT,
        };
    }
}
