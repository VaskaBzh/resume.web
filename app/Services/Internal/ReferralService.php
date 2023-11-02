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
     * @param Sub $referrerSub
     * @return string $code
     * @throws \Exception
     */
    public static function generateCode(Sub $referrerSub): string
    {
        try {
            $code = static::generateReferralCode(subGroupId: $referrerSub->group_id);

            GenerateReferralCode::execute(
                referralData: ReferralData::fromRequest([
                    'user' => $referrerSub->user,
                    'code' => $code,
                ])
            );

            return $code;
        } catch (\Exception) {
            throw new \Exception('Something went wrong..');
        }
    }

    public static function getReferrerStatistic(Sub $referrerSub): array
    {
        $activeReferralSubs = $referrerSub
            ->referrals()
            ->with('user')
            ->hasWorkerHashRate()
            ->get();

        $referralSubs = $referrerSub
            ->referrals()
            ->with('incomes', static function ($query) {
                $query->where('type', 'referral');
            })
            ->get();

        return [
            'attached_referrals_count' => $referralSubs
                ->unique('user.id')
                ->count(),
            'referrals_total_amount' => $referralSubs->flatMap(
                static fn(Sub $referralSub) => $referralSub->incomes->pluck('daily_amount'))
                ->sum(),
            'active_referrals_count' => $activeReferralSubs
                ->unique('user.id')
                ->count(),
            'total_referrals_hash_rate' => $activeReferralSubs->sum('total_hash_rate')
        ];
    }

    public static function getReferralCollection(User $user): Collection
    {
        $referrerSubs = Sub::whereIn('group_id', $user->subs()->pluck('group_id'))->get();

        return Sub::with('user')
            ->with('workers')
            ->whereIn('referrer_id', $referrerSubs->pluck('group_id'))
            ->get()
            ->map(static function (Sub $referralSub) {

                return [
                    'email' => $referralSub->user->email,
                    'referral_active_workers_count' => $referralSub->workers
                        ->where('status', 'ACTIVE')
                        ->count(),
                    'referral_inactive_workers_count' => $referralSub->workers
                        ->where('status', 'INACTIVE')
                        ->count(),
                    'referral_hash_per_day' => $referralSub->workers->sum('approximate_hash_rate'),
                    'total_amount' => Income::whereIn('group_id',
                        Sub::where('user_id', $referralSub->user_id)->pluck('group_id')
                    )
                        ->where('type', 'referral')
                        ->sum('daily_amount')
                ];
            });
    }

    /**
     * Return referrer sub-account
     *
     * @param string $code
     * @return Sub
     */
    public static function getReferrer(string $code): Sub
    {
        return Sub::find(self::getReferralDataFromCode(code: $code)['group_id']);
    }

    /**
     * Encode sub-account group_id to string
     *
     * @param int $subGroupId
     * @return string
     */
    public static function generateReferralCode(int $subGroupId): string
    {
        return base64_encode(json_encode(['group_id' => $subGroupId]));
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
