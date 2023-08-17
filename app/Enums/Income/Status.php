<?php

declare(strict_types=1);

namespace App\Enums\Income;

enum Status: string
{
    case PENDING = 'pending';
    case READY_TO_PAYOUT = 'ready to payout';
    case COMPLETED = 'completed';
    case REJECTED = 'rejected';
}
