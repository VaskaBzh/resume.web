<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hash;
use App\Models\Income;
use App\Models\Sub;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function __invoke(Request $request, Sub $sub): JsonResponse
    {
        return new JsonResponse([
            'hashes' => Hash::getByOffset($sub->group_id, $request->offset)
                ->select('hash', 'unit', 'worker_count')
                ->get(),
            'incomes' => Income::getByGroupId($sub->group_id)
                ->selectRaw('daily_amount as amount')
                ->latest()
                ->take(30)
                ->get(),
        ]);
    }
}
