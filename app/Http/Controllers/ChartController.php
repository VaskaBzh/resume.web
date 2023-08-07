<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ChartResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class ChartController extends Controller
{
    public function __invoke(): JsonResource
    {
        $response = Http::get('https://api.blockchain.info/charts/difficulty')
            ->collect();

        return new ChartResource($response);
    }
}
