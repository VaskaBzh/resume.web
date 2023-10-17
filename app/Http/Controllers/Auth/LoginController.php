<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    #[
        OA\Post(
            path: '/login',
            summary: 'User login',
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\JsonContent(
                    ref: '#/components/schemas/LoginRequest',
                    type: 'object'
                )
            ),
            tags: ['Auth'],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: "Successful login",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: "user",
                                ref: "#/components/schemas/UserResource"
                            ),
                            new OA\Property(
                                property: "token",
                                description: "User access token",
                                type: "string"
                            ),
                            new OA\Property(
                                property: "expired_at",
                                description: "Token expiration date",
                                type: "string",
                                format: "date-time"
                            ),
                        ],
                        type: 'object'
                    )
                ),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Not found (Look validation error schema)'),
                new OA\Response(response: Response::HTTP_FORBIDDEN, description: 'Forbidden (Look validation error schema)'),
                new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY,
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
            ]
        )
    ]
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return new JsonResponse([
                'errors' => [
                    'auth' => [__('auth.failed')]
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        if (!$request->user->hasVerifiedEmail()) {
            return new JsonResponse([
                'errors' => [
                    'auth' => [__('auth.email.not.verified', ['email' => $request->user->email])]
                ]
            ], Response::HTTP_FORBIDDEN);
        }

        $request
            ->user
            ->tokens()
            ->delete();

        $token = $request
            ->user
            ->createToken($request->user->name,
                ['*'],
                now()->addMinutes(config('sanctum.expiration'))
            );

        return new JsonResponse([
            'user' => new UserResource($request->user),
            'token' => $token->plainTextToken,
            'expired_at' => $token->accessToken->expires_at,
        ]);
    }


    #[
        OA\Post(
            path: '/logout',
            summary: 'User logout',
            security: [['bearer' => []]],
            tags: ['Auth'],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'Successfully logged out',
                    content: new OA\JsonContent(
                        description: 'Logout confirmation message',
                        type: 'string'
                    )
                ),
                new OA\Response(
                    response: Response::HTTP_UNAUTHORIZED,
                    description: 'Unauthorized',
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
    public function logout(): JsonResponse
    {
        auth()->user()
            ?->tokens()
            ->delete();

        return response()->json('Logged out');
    }


    #[
        OA\Put(
            path: '/decrease/token',
            summary: 'Decrease the expiration time of the current token',
            security: [['bearer' => []]],
            tags: ['Auth'],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'Accept (Token expiration time decreased successfully)'
                ),
                new OA\Response(
                    response: Response::HTTP_UNAUTHORIZED,
                    description: 'Unauthorized',
                    content: [
                        new OA\JsonContent(
                            properties: [
                                new OA\Property(
                                    property: 'error',
                                    description: 'Error message',
                                    type: 'string'
                                )
                            ]
                        )
                    ]
                )
            ]
        )
    ]
    public function decreaseTokenTime(): void
    {
        auth()
            ->user()
            ->tokens()
            ->first()
            ->update(['expires_at' => now()->addHours(2)]);
    }
}
