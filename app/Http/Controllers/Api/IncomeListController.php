<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Dto\FilterData;
use App\Http\Controllers\Controller;
use App\Http\Resources\IncomeCollection;
use App\Models\Income;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomeListController extends Controller
{
    public function __invoke(Sub $sub, Request $request): JsonResource
    {
        $filterData = FilterData::fromRequest($request->all());

        $collection = Income::getList($sub->group_id, $filterData->hasTxId)
            ->paginate($filterData->perPage);

        return new IncomeCollection($collection);
    }
}
