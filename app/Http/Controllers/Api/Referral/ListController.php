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
    /**
     * @OA\Get(
     *     path="/referrals/{user}",
     *     summary="Get referral subs for a user",
     *     tags={"Referral"},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User's ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="referral_subs", type="array",
     *                 @OA\Items(ref="#/components/schemas/ReferralResourceCollection")
     *             ),
     *         )
     *     ),
     *     @OA\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function __invoke(User $user, BtcComService $btcComService)
    {
        if (!$user?->referral_code) {
            return new JsonResponse(['error' => __('actions.referral.code.exists')], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $referralCodeData = ReferralService::getReferralDataFromCode($user->referral_code);

        $owner = Sub::find($referralCodeData['group_id']);

        $referralSubs = ReferralService::getReferralCollection(owner: $owner, btcComService: $btcComService);

        return new ReferralResourceCollection($referralSubs);
    }
}
