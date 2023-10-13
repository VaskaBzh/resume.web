<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Referral;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Get(
 *     path="/referrals/incomes/{user}",
 *     summary="Get referral incomes list for a user",
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
 *             @OA\Property(property="current_page", type="integer"),
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="email", type="string"),
 *                     @OA\Property(property="daily_amount", type="string"),
 *                     @OA\Property(property="hash", type="float"),
 *                     @OA\Property(property="created_at", type="string"),
 *                     @OA\Property(property="worker_count", type="integer")
 *                 )
 *             ),
 *             @OA\Property(property="first_page_url", type="string"),
 *             @OA\Property(property="from", type="integer"),
 *             @OA\Property(property="last_page", type="integer"),
 *             @OA\Property(property="last_page_url", type="string"),
 *             @OA\Property(property="links", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="url", type="string"),
 *                     @OA\Property(property="label", type="string"),
 *                     @OA\Property(property="active", type="boolean")
 *                 )
 *             ),
 *             @OA\Property(property="next_page_url", type="string"),
 *             @OA\Property(property="path", type="string"),
 *             @OA\Property(property="per_page", type="integer"),
 *             @OA\Property(property="prev_page_url", type="string"),
 *             @OA\Property(property="to", type="integer"),
 *             @OA\Property(property="total", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=422, description="Unprocessable Entity"),
 * )
 */
class IncomeListController extends Controller
{
    public function __invoke(User $user, Request $request)
    {
        if (!$user?->referral_code) {
            return new JsonResponse([
                'error' => __('actions.referral.exists')
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return ReferralService::getReferralIncomes($user->subs()->first()->group_id, 15);
    }
}
