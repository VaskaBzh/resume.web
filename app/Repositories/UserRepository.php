<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function getReferralIncomeCollection(int $groupId, string $perPage = "15"): Builder
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
            ->latest();
    }
}
