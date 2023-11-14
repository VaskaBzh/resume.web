<?php

declare(strict_types=1);

namespace App\Enums\Hash;

enum Unit: string
{
    case TERA_HASH = 'T';
    case PETA_HASH = 'P';
    case GIGA_HASH = 'G';
    case EXA_HASH = 'E';
}
