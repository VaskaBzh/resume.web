<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Sub;
use App\Models\User;

class AttachReferral
{
    public static function execute(Sub $referralSub, Sub $ownerSub, $referralPercent): void
    {
        try {
            $ownerSub
                ->referrals()
                ->attach($referralSub, ['referral_percent' => $referralPercent]);

            $referralSub->update(['percent' => $referralSub->percent - $referralPercent]);
        } catch (\Exception $e) {
            report($e);

            throw new \Exception('Something went wrong');
        }
    }
}
