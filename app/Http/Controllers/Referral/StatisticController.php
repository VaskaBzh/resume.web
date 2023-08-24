<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

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
            return new JsonResponse(['message' => 'referral code not exists'], 422);
        }

        $owner = Sub::find($user->referral_code['group_id']);

        $statistic = ReferralService::getOwnerStatistic(referrals: $owner->referrals()->get());

        return new ReferralStatisticResource($user, $statistic);
    }
}
