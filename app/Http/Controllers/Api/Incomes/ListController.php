<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Incomes;

use App\Http\Controllers\Controller;
use App\Http\Resources\IncomeCollection;
use App\Models\Income;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListController extends Controller
{
    public function __invoke(Sub $sub, Request $request): JsonResource
    {
        return new IncomeCollection(
            Income::getByGroupId($sub->group_id)
                ->between('created_at', $request->from, $request->to)
                ->latest()
                ->paginate($request->per_page ?? 15)
        );
    }
}
