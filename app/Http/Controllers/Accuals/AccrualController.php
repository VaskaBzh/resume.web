<?php

namespace App\Http\Controllers\Accuals;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use Illuminate\Http\Request;


class AccrualController extends Controller
{
    public function visual(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
        ]);

        return Sub::all()->where('group_id', $request->input('group_id'))->first()->accruals;
    }
}
