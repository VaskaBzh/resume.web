<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\User\AttachReferral;
use App\Actions\User\GenerateReferralCode;
use App\Dto\ReferralData;
use App\Exceptions\BusinessException;
use App\Models\Sub;
use App\Models\User;
use App\Models\Worker;
use App\Repositories\IncomeRepository;
use App\Services\External\BtcComService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

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

    public static function getOwnerStatistic(Collection $referrals): array
    {
        $activeReferralSubs = Sub::getActiveSubs($referrals->pluck('id')->toArray())->get();

        return [
            'attached_referrals_count' => $referrals->count(),
            'referrals_total_amount' => resolve(IncomeRepository::class)
                ->getReferralsTotalAmount(referralIds: $referrals->pluck('id')),
            'active_referrals_count' => $activeReferralSubs->count(),
            'total_referrals_hash_rate' => Worker::whereIn('group_id',
                $activeReferralSubs->pluck('group_id')->toArray()
            )
                ->onlyActive()
                ->sum('approximate_hash_rate')
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
                'total_amount' => resolve(IncomeRepository::class)
                    ->getReferralTotalAmount(referralId: $user->pivot->id)
            ];
        });
    }

    public static function getReferralIncomes(int $groupId, int $perPage): LengthAwarePaginator
    {
        return resolve(IncomeRepository::class)
            ->getReferralIncomeCollection(groupId: $groupId,)
            ->paginate($perPage);
    }

    public static function attach(Sub $referralSub, string $code): void
    {
        $decryptedData = self::getReferralDataFromCode(code: $code);

        try {
            AttachReferral::execute(
                referrerSub: Sub::find($decryptedData['group_id']),
                referralSub: $referralSub,
            );
        } catch (\Throwable $e) {
            throw new BusinessException(__('actions.failed'), Response::HTTP_BAD_REQUEST);
        }
    }

    public static function generateReferralCode(int $subGroupId): string
    {
        return base64_encode(json_encode(['group_id' => $subGroupId]));
    }

    public static function getReferralDataFromCode(string $code): array
    {
        return json_decode(base64_decode($code), true);
    }
}
