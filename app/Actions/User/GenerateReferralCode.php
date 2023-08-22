<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Dto\ReferralData;

class GenerateReferralCode
{
    public static function execute(ReferralData $referralData): bool
    {
        return $referralData->user->update([
            'referral_code->group_id' => $referralData->group_id,
            'referral_code->code' => $referralData->code,
        ]);
    }
}
