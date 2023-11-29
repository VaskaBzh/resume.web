<?php

declare(strict_types=1);

namespace App\Enums\Worker;

use Illuminate\Support\Str;

enum Status: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case DEAD = 'DEAD';

    public static function tryFromInsensitive(?string $value): ?self
    {
        return self::tryFrom(Str::upper($value));
    }
}
