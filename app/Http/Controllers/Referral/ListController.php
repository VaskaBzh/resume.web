<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferralResourceCollection;
use App\Models\Sub;
use App\Models\User;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;

class ListController extends Controller
{
    public function __invoke(User $user, BtcComService $btcComService)
    {
        if (!$user->referral_code) {
            return new JsonResponse(['message' => 'referral code not exists'], 422);
        }

        $sub = Sub::find($user->referral_code['group_id']);

        $referralSubs = ReferralService::getReferralCollection(owner: $sub, btcComService: $btcComService);

        return new ReferralResourceCollection($referralSubs);
    }
}
