<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PoolStatsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class PoolStatsController extends Controller
{
    #[
        OA\Get(
            path: '/pool/stats',
            summary: 'Get pool statistics',
            tags: ['Pool stats'],
            responses: [
                new OA\Response(
                    response: Response::HTTP_OK,
                    description: 'Successful response',
                    content: [
                        new OA\JsonContent(
                            ref: '#/components/schemas/PoolStatsResource',
                            type: 'object',
                        ),
                    ],
                ),
            ],
        )
    ]
    public function show(): JsonResource
    {
        abort_if(! File::exists(public_path('poolstats.json')), Response::HTTP_NOT_FOUND);

        $stats = json_decode(File::get(public_path('poolstats.json')), true);

        return new PoolStatsResource($stats);
    }
}
