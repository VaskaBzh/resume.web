<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Builders\SubBuilder;
use App\Models\Income;
use App\Models\Sub;
use App\Models\User;
use App\Utils\HashRateConverter;
use Illuminate\Support\Collection;

final readonly class ReferralService
{
    public static function getReferrerStatistic(User $referrer): array
    {
        $referrer->load('subs');

        $result = User::withCount([
            'referrals as active_referrals_count' => function ($query) {
                $query->whereHas('subs', function (SubBuilder $subQuery) {
                    $subQuery->hasWorkerHashRate();
                });
            },
            'referrals as attached_referrals_count',
        ])->find($referrer->id);

        $activeReferralSubs = Sub::getActive($referrer->referrals->pluck('id'))->get();

        $totalHashRate = HashRateConverter::fromPure($activeReferralSubs
            ->map
            ->hash_rate
            ->sum());

        return [
            'group_id' => $referrer->active_sub,
            'attached_referrals_count' => $result->active_referrals_count,
            'active_referrals_count' => $result->attached_referrals_count,
            'referrals_total_amount' => Income::whereIn('group_id', $referrer->subs->pluck('group_id'))
                ->where('type', 'referral')
                ->sum('daily_amount'),
            'total_referrals_hash_rate' => $totalHashRate->value,
            'hash_rate_unit' => $totalHashRate->unit,
        ];
    }

    public static function getReferralCollection(User $user): Collection
    {
        $referrals = $user->referrals()
            ->with('subs')
            ->with('subs.workers')
            ->get();

        return $referrals->map(function (User $referral) {

            $referralWorkers = $referral->subs->pluck('workers')->flatMap;
            $referralSubs = $referral->subs;
            $totalHashRate = HashRateConverter::fromPure($referralSubs->map->hash_rate->sum());

            return [
                'email' => $referral->email,
                'referral_active_workers_count' => $referralWorkers
                    ->where('status', 'ACTIVE')
                    ->count(),
                'referral_inactive_workers_count' => $referralWorkers
                    ->where('status', 'INACTIVE')
                    ->count(),
                'referral_hash_per_day' => $totalHashRate->value,
                'referral_hash_per_day_unit' => $totalHashRate->unit,
                'total_amount' => $referralSubs->sum('total_amount'),
                'referral_percent' => $referral->referral_percentage,
            ];
        });
    }

    /**
     * Return referrer sub-account
     */
    public static function getReferrer(string $code): User
    {
        return User::find(self::getReferralDataFromCode(code: $code)['user_id']);
    }

    /**
     * Encode sub-account group_id to string
     */
    public static function generateReferralCode(User $referrer): string
    {
        return base64_encode(json_encode(['user_id' => $referrer->id]));
    }

    /**
     * Decode sub-account group_id from code
     */
    public static function getReferralDataFromCode(string $code): array
    {
        return json_decode(base64_decode($code), true);
    }
}
