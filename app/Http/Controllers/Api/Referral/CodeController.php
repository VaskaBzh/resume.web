<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Referral;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

#[
    OA\Post(
        path: '/referrals/generate/{user}',
        summary: 'Generate a referral code for a user',
        security: [['bearer' => []]],
        requestBody: new OA\RequestBody(
            description: 'Request body for generating a referral code',
            required: false,
            content: [
                new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'group_id',
                            type: 'integer',
                        ),
                    ],
                    type: 'object',
                ),
            ],
        ),
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
                description: 'Referral code generated successfully',
                content: [
                    new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'success',
                                type: 'boolean',
                            ),
                            new OA\Property(
                                property: 'message',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'referral_url',
                                type: 'string',
                            ),
                        ],
                        type: 'object',
                    ),
                ],
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: 'Error while generating a referral code',
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
            ),
        ],
    )
]
class CodeController extends Controller
{
    public function __invoke(User $user, Request $request): JsonResponse
    {
        $this->authorize('viewAny', $user);

        try {
            $code = ReferralService::generateCode(
                referrerSub: Sub::findOrFail($request->group_id)
            );

            return new JsonResponse([
                'success' => true,
                'message' => __('actions.referral.code.created'),
                'referral_url' => route('v1.register', 'referral_code=' . $code),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'errors' => [
                    'message' => [__('actions.failed')]
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
