<?php

namespace App\Http\Controllers;

use App\Models\MinerStat;
use Illuminate\Http\JsonResponse;

class MinerStatController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'minerstats' => MinerStat::first(),
        ]);
    }
}
