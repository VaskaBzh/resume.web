<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WorkerHashRate\Resources\IncomeCollection;
use App\Models\Income;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomeListController extends Controller
{
    public function __invoke(Sub $sub, Request $request): JsonResource
    {
        $collection = Income::getByGroupId($sub->group_id)
            ->orderByDesc('created_at')
            ->paginate($request->per_page ?? 15);

        return new IncomeCollection($collection);
    }
}
