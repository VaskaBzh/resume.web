<?php

declare(strict_types=1);

namespace App\Http\Controllers\Hashes;

use App\Http\Controllers\Controller;
use App\Models\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HashController extends Controller
{
    public function visual(Request $request): Collection
    {
        $request->validate([
            'group_id' => 'required',
        ]);

        return Hash::getByGroupId($request->group_id)->get();
    }
}
