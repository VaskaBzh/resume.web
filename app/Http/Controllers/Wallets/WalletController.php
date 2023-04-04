<?php

namespace App\Http\Controllers\Wallets;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
           'group_id' => 'required',
        ]);

        $wallet = Sub::all()->where('group_id', $request->input('group_id'))->first()->wallet()->first();

        if ($request->input('payments')) {
            $request->validate([
                'payments' => 'required',
            ]);

            $wallet->payments = $request->input('payments');
        } else if ($request->input('accruals')) {
            $request->validate([
                'accruals' => 'required',
            ]);

            $wallet->accruals = $request->input('accruals');
        }
        $wallet->save();
    }
    public function visual(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
        ]);

        return Sub::all()->where('group_id', $request->input('group_id'))->first()->wallets;
    }
}
