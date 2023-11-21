<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Dto\Referral\GenerateCodeData;

class GenerateReferralCode
{
    public static function execute(GenerateCodeData $referralData): void
    {
        $referralData->user->update(['referral_code' => $referralData->code]);
    }
}
