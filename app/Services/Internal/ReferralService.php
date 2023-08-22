<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\User\GenerateReferralCode;
use App\Dto\ReferralData;
use App\Helper;
use App\Models\Sub;
use App\Models\User;

class ReferralService
{
    public static function generateCode(User $user, int $groupId): bool
    {
        return GenerateReferralCode::execute(
            referralData: ReferralData::fromRequest([
                'user' => $user,
                'group_id' => $groupId,
                'code' => Helper::generateUniqReferralCode(),
                'sub_profit_percent' => 1,
                'user_discount_percent' => 1,
            ])
        );
    }

    public static function getStatistic(User $user)
    {
        $sub = Sub::getByGroupId($user->referral_code['group_id'])->first();
        dd($sub->referrals()->each(function (User $user) {
            dd($user->subs);
        }));
    }

    public static function transform(Sub $sub)
    {
        return [
            'group_id' => $sub->group_id,
            'attached_referrals_count' => $sub->referrals()->count(),
            'active_referrals_count' => 0,
        ];
    }
}
