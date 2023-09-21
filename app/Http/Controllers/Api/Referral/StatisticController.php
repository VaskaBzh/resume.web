<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Referral;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferralStatisticResource;
use App\Models\Sub;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;

class StatisticController extends Controller
{
    public function __invoke(User $user)
    {
        if (!$user->referral_code) {
            return new JsonResponse(['error' => __('actions.referral.code.exists')], 422);
        }

        $referralCodeData = ReferralService::getReferralDataFromCode($user->referral_code);

        $owner = Sub::find($referralCodeData['group_id']);

        if (!$owner) {
            return new JsonResponse(['error' => __('actions.referral.exists')], 422);
        }

        $statistic = ReferralService::getOwnerStatistic(
            referrals: $owner->referrals()->get()
        );

        return new ReferralStatisticResource($user, $statistic, $referralCodeData);
    }
}
