<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Referral;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferralStatisticResource;
use App\Models\Sub;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Get(
 *     path="/referrals/statistic/{user}",
 *     summary="Get referral statistics for a user",
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
 *             @OA\Property(property="statistic", ref="#/components/schemas/ReferralStatisticResource"),
 *         )
 *     ),
 *     @OA\Response(response=422, description="Unprocessable Entity"),
 *     @OA\Response(response=500, description="Internal Server Error"),
 * )
 */
class StatisticController extends Controller
{
    public function __invoke(User $user)
    {
        if (!$user?->referral_code) {
            return new JsonResponse(['error' => __('actions.referral.code.exists')], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $referralCodeData = ReferralService::getReferralDataFromCode($user->referral_code);

        $owner = Sub::find($referralCodeData['group_id']);

        if (!$owner) {
            return new JsonResponse(['error' => __('actions.referral.exists')], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $statistic = ReferralService::getOwnerStatistic(
            referrals: $owner->referrals()->get()
        );

        return new ReferralStatisticResource($user, $statistic, $referralCodeData);
    }
}
