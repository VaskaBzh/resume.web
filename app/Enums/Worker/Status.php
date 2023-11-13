<?php

declare(strict_types=1);

namespace App\Enums\Worker;

enum Status: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case DEAD = 'DEAD';
}
