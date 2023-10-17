<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChartResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: '/chart',
        summary: 'Get chart data',
        tags: ['Main chart'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Successful response',
                content: [
                    new OA\JsonContent(
                        ref: '#/components/schemas/ChartResource'
                    )
                ],
            ),
        ],
    )
]
class ChartController extends Controller
{
    public function __invoke(): JsonResource
    {
        return new ChartResource(
            Http::get('https://api.blockchain.info/charts/difficulty')->collect()
        );
    }
}
