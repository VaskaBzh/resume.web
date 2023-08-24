<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\User\GenerateReferralCode;
use App\Dto\ReferralData;
use App\Helper;
use App\Http\Resources\IncomeCollection;
use App\Models\Income;
use App\Models\Sub;
use App\Models\User;
use App\Services\External\BtcComService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public static function getOwnerStatistic(Collection $referrals): array
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

    public static function getReferralCollection(Sub $owner, BtcComService $btcComService): Collection
    {
        return $owner->referrals->map(function (User $user) use ($btcComService) {
            $referralSubCollection = $btcComService
                ->transformSubCollection($user->subs);

            return [
                'email' => $user->email,
                'referral_active_workers_count' => $referralSubCollection->sum('workers_count_active'),
                'workers_count_in_active' => $referralSubCollection->sum('workers_count_in_active'),
                'referral_hash_per_day' => $referralSubCollection->sum('hash_per_day'),
                'total_amount' => $user->subs()->sum('total_amount')
            ];
        });
    }

    public static function getReferralIncomeCollection(int $groupId): LengthAwarePaginator
    {

        return DB::table('referrals')
            ->where('referrals.group_id', $groupId)
            ->join('incomes', 'referrals.id', 'incomes.referral_id')
            ->join('users', 'referrals.user_id', 'users.id')
            ->join('subs', 'referrals.user_id', 'subs.user_id')
            ->join('workers', 'subs.group_id', 'workers.group_id')
            ->selectRaw(
                'users.email,
                incomes.daily_amount,
                incomes.hash,
                incomes.created_at,
                count(workers.id) as worker_count'
            )
            ->groupBy('incomes.id')
            ->paginate();
    }
}
