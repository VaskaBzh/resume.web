<?php

declare(strict_types=1);

namespace App\Enums\User;

enum Roles: string
{
    case REFERRER = 'referrer';
    case REFERRAL = 'referral';
}
