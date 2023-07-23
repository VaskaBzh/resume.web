<?php

namespace App\Http\Controllers\MinerStat;

use App\Models\MinerStat;
use Illuminate\Http\JsonResponse;

class MinerStatController
{
    public function visual(): JsonResponse
    {
        return new JsonResponse([
            'minerstats' => MinerStat::first(),
        ]);
    }
}
