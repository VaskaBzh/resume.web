<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    #[
        OA\Get(
            path: '/user/{user}',
            summary: 'Get user',
            security: [['bearer' => []]],
            tags: ['User'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    description: 'User\'s ID',
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
                            ref: '#/components/schemas/UserResource'
                        )
                    ]
                ),
                new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
                new OA\Response(
                    response: Response::HTTP_NOT_FOUND,
                    description: 'Not Found',
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
            ]
        )
    ]
    public function __invoke(User $user): UserResource
    {
        $this->authorize('viewAny', $user);

        return new UserResource($user);
    }
}
