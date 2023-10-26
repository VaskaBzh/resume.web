<?php

namespace App\Http\Controllers\Auth;

use App\Dto\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\External\BtcComService;
use App\Services\Internal\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class RegisterController extends Controller
{
    use RegistersUsers;

    #[
        OA\Post(
            path: '/register',
            summary: 'Register a user',
            requestBody: new OA\RequestBody(
                description: 'Request body for user registration',
                required: true,
                content: [
                    new OA\JsonContent(
                        required: [
                            'name',
                            'email',
                            'password',
                            'password_confirmation',
                        ],
                        properties: [
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'email',
                                type: 'string',
                                format: 'email',
                            ),
                            new OA\Property(
                                property: 'password',
                                type: 'string',
                                maxLength: 50,
                                minLength: 10,
                            ),
                            new OA\Property(
                                property: 'password_confirmation',
                                type: 'string',
                                maxLength: 50,
                                minLength: 10,
                            ),
                            new OA\Property(
                                property: 'referral_code',
                                type: 'string',
                            ),
                        ],
                        type: 'object',
                    ),
                ],
            ),
            tags: ['Auth'],
            responses: [
                new OA\Response(
                    response: Response::HTTP_CREATED,
                    description: 'User registered successfully',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'message',
                                    type: 'string',
                                ),
                                new OA\Property(
                                    property: 'user',
                                    ref: '#/components/schemas/UserResource',
                                ),
                                new OA\Property(
                                    property: 'token',
                                    type: 'string',
                                ),
                            ],
                            type: 'object',
                        ),
                    ],
                ),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Validation error',
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
            ],
        )
    ]
    public function register(
        RegisterRequest $request,
        BtcComService   $btcComService
    ): JsonResponse
    {
        $userData = UserData::fromRequest($request->all());

        $response = $btcComService->createSub(userData: $userData);

        auth()->login($user = UserService::create(userData: $userData));

        $btcComService->createLocalSub(
            userData: UserData::fromRequest(requestData: array_merge($request->all(), ['id' => $user->id])),
            groupId: $response['gid']
        );

        event(new Registered(
            user: $user
        ));

        return new JsonResponse([
            'message' => 'success',
            'user' => new UserResource($user),
            'token' => $user->createToken(
                $user->name,
                ['*'],
                now()->addMinutes(config('sanctum.expiration'))
            )->plainTextToken
        ], Response::HTTP_CREATED);
    }
}
