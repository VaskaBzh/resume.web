<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Referral;

use App\Http\Controllers\Controller;
use App\Http\Resources\Referral\ReferralStatisticResource;
use App\Models\User;
use App\Services\Internal\ReferralService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class StatisticController extends Controller
{
    #[
        OA\Get(
            path: '/referrals/statistic/{user}',
            summary: 'Get referral statistics for a user',
            security: [['bearer' => []]],
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
                                ),
                            ],
                            type: 'object',
                        ),
                    ],
                ),
                new OA\Response(
                    response: Response::HTTP_NOT_FOUND,
                    description: 'Not found',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message'],
                                ],
                            ]
                        ),
                    ],
                ),
            ],
        )
    ]
    public function __invoke(User $user)
    {
        $this->authorize('viewAny', $user);

        $statistic = ReferralService::getReferrerStatistic(referrer: $user);

        return new ReferralStatisticResource($user, $statistic);
    }
}
