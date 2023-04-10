<?php

namespace App\Http\Controllers\Hashes;

use App\Http\Controllers\Controller;
use App\Models\Hash;
use App\Models\Sub;
use App\Models\Worker;
use Illuminate\Http\Request;


class HashController extends Controller
{
    public function visual(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
        ]);

        return Sub::all()->where('group_id', $request->input('group_id'))->first()->hashes;
    }
}
