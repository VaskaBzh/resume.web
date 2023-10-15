<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Referral;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class IncomeListController extends Controller
{
    #[
        OA\Get(
            path: "/referrals/incomes/{user}",
            summary: "Get referral incomes list for a user",
            security: [['bearerAuth' => []]],
            tags: ["Referral"],
            parameters: [
                new OA\Parameter(
                    name: "user",
                    description: "User's ID",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful response",
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(property: "current_page", type: "integer"),
                                new OA\Property(
                                    property: "data",
                                    type: "array",
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: "email", type: "string"),
                                            new OA\Property(property: "daily_amount", type: "string"),
                                            new OA\Property(property: "hash", type: "float"),
                                            new OA\Property(property: "created_at", type: "string"),
                                            new OA\Property(property: "worker_count", type: "integer"),
                                        ],
                                        type: "object"
                                    ),
                                ),
                                new OA\Property(property: "first_page_url", type: "string"),
                                new OA\Property(property: "from", type: "integer"),
                                new OA\Property(property: "last_page", type: "integer"),
                                new OA\Property(property: "last_page_url", type: "string"),
                                new OA\Property(
                                    property: "links",
                                    type: "array",
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: "url", type: "string"),
                                            new OA\Property(property: "label", type: "string"),
                                            new OA\Property(property: "active", type: "boolean"),
                                        ],
                                        type: "object"
                                    ),
                                ),
                                new OA\Property(property: "next_page_url", type: "string"),
                                new OA\Property(property: "path", type: "string"),
                                new OA\Property(property: "per_page", type: "integer"),
                                new OA\Property(property: "prev_page_url", type: "string"),
                                new OA\Property(property: "to", type: "integer"),
                                new OA\Property(property: "total", type: "integer"),
                            ],
                            type: "object"
                        ),
                    ]
                ),
                new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: "Unauthorized"),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: "User or referral code not found"),
            ]
        )
    ]
    public function __invoke(User $user, Request $request)
    {
        if (!$user?->referral_code) {
            return new JsonResponse([
                'error' => __('actions.referral.exists')
            ], Response::HTTP_NOT_FOUND);
        }

        return ReferralService::getReferralIncomes($user->subs()->first()->group_id, 15);
    }
}
