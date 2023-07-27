<?php

declare(strict_types=1);

namespace App\Enums\Income;
enum Message: string
{
    case NO_WALLET = 'no wallet';
    case LESS_MIN_WITHDRAWAL = 'less minWithdrawal';
    case ERROR = 'error';
    case ERROR_PAYOUT = 'error payout';
    case COMPLETED = 'completed';
}
