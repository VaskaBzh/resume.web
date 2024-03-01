<?php

declare(strict_types=1);

namespace App\Enums\Income;

enum Status: string
{
    case PENDING = 'pending';
    case NO_WALLET = 'wallet needed';
    case ON_VERIFY = 'verification';
    case READY_TO_PAYOUT = 'ready to payout';
    case COMPLETED = 'completed';
    case ERROR = 'error';
}
