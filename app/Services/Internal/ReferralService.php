<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\User\GenerateReferralCode;
use App\Dto\ReferralData;
use App\Models\Income;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Support\Collection;

class ReferralService
{
    /**
     * Сгенерируем на основе group_id строковый код
     * Сохраним его связанному пользователю
     *
     * @param User $referrer
     * @return string $code
     * @throws \Exception
     */
    public static function generateCode(User $referrer): string
    {
        try {
            $code = static::generateReferralCode(referrer: $referrer);

            GenerateReferralCode::execute(
                referralData: ReferralData::fromRequest([
                    'user' => $referrer,
                    'code' => $code,
                ])
            );

            return $code;
        } catch (\Exception) {
            throw new \Exception('Something went wrong..');
        }
    }

    public static function getReferrerStatistic(User $referrer): array
    {
        $referrer->load([
            'subs',
            'referrals',
            'referrals.subs'
        ]);

        $activeReferralSubs = Sub::getActive($referrer->referrals->pluck('id'))->get();

        return [
            'group_id' => $referrer->active()
                ->first()
                ->group_id,
            'attached_referrals_count' => $referrer->referrals->count(),
            'active_referrals_count' => $activeReferralSubs
                ->unique('user_id')
                ->count(),
            'referrals_total_amount' => Income::whereIn('group_id', $referrer->subs->pluck('group_id'))
                ->where('type', 'referral')
                ->sum('daily_amount'),
            'total_referrals_hash_rate' =>  $activeReferralSubs->map->total_hash_rate->sum()
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
                'referral_hash_per_day' => $referralSubs->map->total_hash_rate->sum(),
                'total_amount' => Income::getReferralIncomes($referralSubs->pluck('group_id'))
                    ->sum('daily_amount'),
                'referral_percent' => $referral->referral_percentage
            ];
        });
    }

    /**
     * Return referrer sub-account
     *
     * @param string $code
     * @return User
     */
    public static function getReferrer(string $code): User
    {
        return User::find(self::getReferralDataFromCode(code: $code)['user_id']);
    }

    /**
     * Encode sub-account group_id to string
     *
     * @param User $user
     * @return string
     */
    public static function generateReferralCode(User $referrer): string
    {
        return base64_encode(json_encode(['user_id' => $referrer->id]));
    }

    /**
     * Decode sub-account group_id from code
     *
     * @param string $code
     * @return array
     */
    public static function getReferralDataFromCode(string $code): array
    {
        return json_decode(base64_decode($code), true);
    }
}
