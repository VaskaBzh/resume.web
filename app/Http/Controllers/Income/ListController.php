<?php

declare(strict_types=1);

namespace App\Http\Controllers\Income;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WorkerHashRate\Resources\IncomeCollection;
use App\Models\Income;
use App\Models\Sub;

class ListController extends Controller
{
    public function __invoke(Sub $sub): IncomeCollection
    {
        $collection = Income::getByGroupId($sub->group_id)
            ->orderByDesc('created_at')
            ->paginate($request->per_page ?? 15);

        return new IncomeCollection($collection);
    }
}
