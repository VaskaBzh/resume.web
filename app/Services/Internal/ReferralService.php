<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\User\GenerateReferralCode;
use App\Dto\ReferralData;
use App\Helper;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Support\Collection;

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

    public static function getStatistic(Collection $referrals): array
    {
        return [
            'attached_referrals_count' => $referrals->count(),
            ...$referrals->reduce(static function (array $acc, User $user) {
                $activeReferralSubs = Sub::getActiveReferrals($user)->get();

                $acc['active_referrals_count'] += $activeReferralSubs->count();
                $acc['referrals_total_amount'] += $activeReferralSubs->sum('total_amount');

                return $acc;
            }, ['active_referrals_count' => 0, 'referrals_total_amount' => 0])
        ];
    }
}
