<?php

declare(strict_types=1);

namespace App\Enums\Hash;

enum Unit: string
{
    case T = 'T';
    case P = 'P';
    case G = 'G';
    case E = 'E';
}
