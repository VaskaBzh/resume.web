<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class IncomeRepository
{
    public function getReferralIncomeCollection(int $groupId, ?int $perPage = 15): LengthAwarePaginator
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
            ->latest()
            ->paginate($perPage);
    }

    public function getReferralTotalAmount(int $referralId): string|float|null
    {
        return DB::table('incomes')
            ->where('referral_id', $referralId)
            ->sum('daily_amount');
    }

    public function getReferralsTotalAmount(Collection $referralIds): string|float|null
    {
        return DB::table('referrals')
            ->join('incomes', 'incomes.referral_id', 'referrals.id')
            ->whereIn('referrals.user_id', $referralIds)
            ->sum('incomes.daily_amount');
    }
}