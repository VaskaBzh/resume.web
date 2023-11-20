<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Models\Income;
use App\Models\Sub;
use App\Models\User;
use App\Utils\HashRateConverter;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class ReferralService
{
    public static function getReferrerStatistic(User $referrer): array
    {
        $referrer->load('subs');

        $result = User::withCount('referrals')
            ->with(['subs' => function (HasMany $query) {
                $query->withSum(['workers as total_referrals_hash_rate'], 'hash_per_day')
                    ->where('');
            }])->find($referrer->id);

        dd($result);

        dd($result);
        $referrer->load([
            'subs',
            'referrals',
            'referrals.subs',
        ]);

        $activeReferralSubs = Sub::getActive($referrer->referrals->pluck('id'))->get();

        $totalHashRate = HashRateConverter::fromPure($activeReferralSubs
            ->map
            ->hash_rate
            ->sum());

        return [
            'group_id' => $referrer->active_sub,
            'attached_referrals_count' => $referrer->referrals
                ->count(),
            'active_referrals_count' => $activeReferralSubs
                ->unique('user_id')
                ->count(),
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

            return [
                'email' => $referral->email,
                'referral_active_workers_count' => $referralWorkers
                    ->where('status', 'ACTIVE')
                    ->count(),
                'referral_inactive_workers_count' => $referralWorkers
                    ->where('status', 'INACTIVE')
                    ->count(),
                'referral_hash_per_day' => $referralSubs->map->hash_rate->sum(),
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
