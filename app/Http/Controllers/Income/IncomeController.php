<?php

declare(strict_types=1);

namespace App\Http\Controllers\Income;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeRequest;
use App\Models\Income;
use Illuminate\Database\Eloquent\Collection;

class IncomeController extends Controller
{
    public function __invoke(IncomeRequest $request): Collection
    {
        return Income::getByGroupId($request->group_id)->get();
    }
}
