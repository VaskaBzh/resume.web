<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Sub;

class AttachReferral
{
    public static function execute(Sub $referralSub, Sub $ownerSub, $referralPercent): void
    {
        $ownerSub
            ->referrals()
            ->attach($referralSub, ['referral_percent' => $referralPercent]);

        $referralSub->update(['percent' => $referralSub->percent - $referralPercent]);
    }
}
