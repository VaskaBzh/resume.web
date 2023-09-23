<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Referral;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferralResourceCollection;
use App\Models\Sub;
use App\Models\User;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListController extends Controller
{
    public function __invoke(BtcComService $btcComService)
    {
        $user = auth()->user();

        if (!$user?->referral_code) {
            return new JsonResponse(['error' => __('actions.referral.code.exists')], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $referralCodeData = ReferralService::getReferralDataFromCode($user->referral_code);

        $owner = Sub::find($referralCodeData['group_id']);

        $referralSubs = ReferralService::getReferralCollection(owner: $owner, btcComService: $btcComService);

        return new ReferralResourceCollection($referralSubs);
    }
}
