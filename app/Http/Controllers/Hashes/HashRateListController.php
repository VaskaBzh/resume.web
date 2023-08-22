<?php

namespace App\Http\Controllers\Hashes;

use App\Http\Controllers\Controller;
use App\Http\Resources\HashRateResource;
use App\Models\Hash;
use App\Models\Sub;
use Illuminate\Http\Request;

class HashRateListController extends Controller
{
    public function __invoke(Sub $sub, Request $request)
    {
        $hashes = Hash::getByOffset($sub->group_id, $request->offset)->get();

        return HashRateResource::collection($hashes);
    }
}
