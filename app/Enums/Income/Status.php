<?php

declare(strict_types=1);

namespace App\Enums\Income;

enum Status: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case REJECTED = 'rejected';
}
