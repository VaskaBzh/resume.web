<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sub\SubResource;
use App\Models\Sub;
use App\Services\Internal\SubService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ShowController extends Controller
{
    #[
        OA\Get(
            path: '/subs/sub/{sub}',
            summary: 'Get subaccount',
            security: [['bearer' => []]],
            tags: ['Subaccount'],
            parameters: [
                new OA\Parameter(
                    name: 'sub',
                    description: "Sub's ID",
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
                            ref: '#/components/schemas/SubResource'
                        ),
                    ],
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
                                    'property' => ['message'],
                                ],
                            ]
                        ),
                    ],
                ),
            ],
        )
    ]
    public function __invoke(
        Request $request,
        Sub $sub,
        SubService $subService,
    ): JsonResource {
        if (! $request->attributes->get('access_key_valid')) {

            $this->authorize('viewOrChange', $sub);
        }

        return new SubResource($subService->getSub($sub));
    }
}
