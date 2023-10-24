<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Dto\ReferralData;

class GenerateReferralCode
{
    public static function execute(ReferralData $referralData): void
    {
        $referralData->user->update(['referral_code' => $referralData->code]);
    }
}
