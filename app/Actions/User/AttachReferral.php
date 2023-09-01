<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Sub;
use App\Models\User;

class AttachReferral
{
    public static function execute(User $referral, Sub $owner): void
    {
        try {
            $owner
                ->referrals()
                ->attach($referral, ['referral_percent' => 0.8]);

            $owner->update(['percent' => $owner->percent - 0.08]);
        } catch (\Exception $e) {
            report($e);

            throw new \Exception('Something went wrong');
        }
    }
}
