<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class AttachReferral
{
    public static function execute(User $referrer, User $referral): void
    {
        $referral->update([
            'referrer_id' => $referrer->id,
            'referral_discount' => $referrer->referral_discount,
        ]);
    }
}
