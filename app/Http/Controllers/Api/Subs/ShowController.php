<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Subs;

use App\Http\Controllers\Controller;
use App\Models\Sub;

class ShowController extends Controller
{
    public function __invoke(Sub $sub)
    {

        //

//        accruals: null
//payments: null
//un_payments: null
//workers_count_active: 1 (workers_active)
//workers_count_in_active: 1 (workers_inactive)
//workers_count_unstable: 1 (workers_dead)
//hash_per_min: 120 (shares_1m)
//hash_per_day: 115
//unit: T (shares_unit)
//today_forcast: 0.00034322
//reject_percent: 0.000 (reject_percent)

    }
}
