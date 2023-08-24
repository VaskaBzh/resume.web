<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Sub;
use App\Models\User;

class AttachReferral
{
    public static function execute(User $referral, Sub $owner)
    {
        $owner->referrals()->attach($referral, ['sub_profit_percent' => 1, 'user_discount_percent' => 1]);
    }
}
