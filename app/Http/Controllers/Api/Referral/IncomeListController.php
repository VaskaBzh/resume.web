<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Referral;

use App\Http\Controllers\Controller;
use App\Http\Resources\Referral\ReferralIncomeResource;
use App\Models\Income;
use App\Models\User;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class IncomeListController extends Controller
{
    #[
        OA\Get(
            path: "/referrals/incomes/{user}",
            summary: "Get referral incomes list for a user",
            security: [['bearer' => []]],
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
                new OA\Response(
                    response: Response::HTTP_NOT_FOUND,
                    description: 'Not found',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message']
                                ]
                            ]
                        ),
                    ],
                )
            ]
        )
    ]
    public function __invoke(User $user)
    {
        $referralsIncomeCollection = Income::join('users', 'referral_id', '=', 'users.id')
            ->where('incomes.referral_id', $user->referrals()->pluck('id'))
            ->select('users.email', 'incomes.daily_amount', 'incomes.hash', 'incomes.created_at')
            ->latest()
            ->paginate();

        return ReferralIncomeResource::collection($referralsIncomeCollection);
    }
}
