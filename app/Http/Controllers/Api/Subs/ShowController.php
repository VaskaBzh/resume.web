<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Subs;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __invoke(Sub $sub)
    {
        return new JsonResponse([
            "accruals" => null,
            "sub" => "Main112",
            "payments" => null,
            "un_payments" => null,
            "workers_count_active" => 1,
            "workers_count_in_active" => 1,
            "workers_count_unstable" => 1,
            "hash_per_min" => 120,
            "hash_per_day" => 105,
            "unit" => "T",
            "today_forcast" => 0.00034322,
            "reject_percent" => "0",
        ]);
    }
}
