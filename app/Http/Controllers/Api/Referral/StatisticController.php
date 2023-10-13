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
use OpenApi\Attributes as OA;

class StatisticController extends Controller
{
    #[
        OA\Get(
            path: '/referrals/statistic/{user}',
            summary: 'Get referral statistics for a user',
            security: [['bearerAuth' => []]],
            tags: ['Referral'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    description: "User's ID",
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'Successful response',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'statistic',
                                    ref: '#/components/schemas/ReferralStatisticResource'
                                )
                            ],
                            type: 'object',
                        ),
                    ],
                ),
                new OA\Response(
                    response: 422,
                    description: 'Unprocessable Entity',
                ),
                new OA\Response(
                    response: 500,
                    description: 'Internal Server Error',
                ),
            ],
        )
    ]
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
