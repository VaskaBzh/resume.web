<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\User\AttachReferral;
use App\Actions\User\GenerateReferralCode;
use App\Dto\ReferralData;
use App\Models\Sub;
use App\Models\User;
use App\Services\External\BtcComService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReferralService
{
    /**
     * @param User $user
     * @param int $groupId
     * @return void
     * @throws \Exception
     */
    public static function generateCode(User $user, int $groupId): string
    {
        try {
            $code = static::generateReferralCode(subGroupId: $groupId);

            GenerateReferralCode::execute(
                referralData: ReferralData::fromRequest([
                    'user' => $user,
                    'code' => $code,
                ])
            );

            return $code;
        } catch (\Exception) {
            throw new \Exception('Something went wrong..');
        }
    }

    public static function getOwnerStatistic(Collection $referrals): array
    {
        return [
            'attached_referrals_count' => $referrals->count(),
            'referrals_total_amount' => DB::table('referrals')
                ->join('incomes', 'incomes.referral_id', 'referrals.id')
                ->whereIn('referrals.user_id', $referrals->pluck('id'))
                ->sum('incomes.daily_amount'),
            'active_referrals_count' => $referrals->reduce(
                static fn(int $acc, User $user) => $acc += Sub::getActiveReferrals($user)->count(),
                0)
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
                'referral_inactive_workers_count' => $referralSubCollection->sum('workers_count_in_active'),
                'referral_hash_per_day' => $referralSubCollection->sum('hash_per_day'),
                'total_amount' => DB::table('incomes')
                    ->where('referral_id', $user->pivot->id)
                    ->sum('daily_amount')
            ];
        });
    }

    public static function getReferralIncomeCollection(int $groupId, string $perPage = "15"): LengthAwarePaginator
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

    public static function attach(User $user, string $code): void
    {
        $owner = User::where('referral_code', $code)->first();

        if (!$owner) {
            throw new \Exception('Неверный код');
        }

        if ($owner->id === $user->id) {
            throw new \Exception('Нельзя добавить собственный аккаунт');
        }

        $decryptedData = static::getReferralDataFromCode(code: $code);

        AttachReferral::execute(
            referralSub: $user->subs()->first(),
            ownerSub: Sub::with('user')->find($decryptedData['group_id']),
            referralPercent: $decryptedData['referral_percent'],
        );
    }

    public static function generateReferralCode(int $subGroupId): string
    {
        return base64_encode(json_encode(['group_id' => $subGroupId, 'referral_percent' => 0.8]));
    }

    public static function getReferralDataFromCode(string $code): array
    {
        return json_decode(base64_encode($code), true);
    }
}
