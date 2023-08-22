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
        $owner = Sub::getByGroupId($user->referral_code['group_id'])->first();

        $statistic = [
            'group_id' => $owner->group_id,
            'referral_code' => $user->referral_code['code'],
            'attached_referrals_count' => $owner->referrals()->count(),
            'active_referrals_count' => 0,
        ];

        $activeReferralsStatistic = $owner->referrals->map(function (User $user) use ($statistic) {
            $activeReferralSubs = Sub::whereIn('group_id',
                $user->subs()->pluck('group_id')
            )
                ->hasWorkerHashRate()
                ->get();

            return array_merge($statistic, );
            return [
                'active_referrals_count' => $activeReferralSubs->count(),
                'referrals_total_amount' => $activeReferralSubs->sum('total_amount')
            ];
        });

        dd($activeReferralsStatistic->merge($statistic));
    }
}
