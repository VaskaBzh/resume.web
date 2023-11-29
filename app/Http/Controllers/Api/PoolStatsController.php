<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PoolStatsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
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
        $stats = json_decode(Storage::disk('public')->get('poolstats.json'), true);

        abort_if(! $stats, Response::HTTP_NOT_FOUND);

        return new PoolStatsResource($stats);
    }
}
