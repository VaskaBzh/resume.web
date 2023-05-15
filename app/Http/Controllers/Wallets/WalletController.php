<?php

namespace App\Http\Controllers\Wallets;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    public function create(Request $request)
    {
        $messages = [
            'wallet.required' => 'Введите ссылку на кошелек',
            'percent.integer' => 'Процент должен быть числом.',
            'percent.min' => 'Процент должен быть больше 1.',
            'percent.max' => 'Процент не может быть больше 100.',
            'minWithdrawal.numeric' => 'Вывод должен быть числом.',
            'minWithdrawal.gt' => 'Вывод должен быть больше 0.005.',
            'name.min' => 'Имя должно иметь больше трех букв',
        ];

        $request->validate([
           'group_id' => 'required',
           'wallet' => 'required',
        ], $messages);

        $wallet = new Wallet([
            'group_id' => $request->input("group_id"),
            'wallet' => $request->input("wallet"),
        ]);

        if ($request->input('percent')) {
            $request->validate([
                'percent' => 'integer|min:1|max:100',
            ], $messages);

            $wallet->percent = $request->input('percent');
        }
        if ($request->input('minWithdrawal')) {
            $request->validate([
                'minWithdrawal' => 'numeric|gt:0.004',
            ], $messages);

            $wallet->minWithdrawal = $request->input('minWithdrawal');
        }
        if ($request->input('name')) {
            $request->validate([
                'name' => 'min:3',
            ], $messages);

            $wallet->name = $request->input("name");
        }
        $wallet->save();
    }
    public function delete(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
            'wallet' => 'required',
        ]);

        $wallets = Sub::all()->firstWhere("group_id", $request->input("group_id"))->wallets;
        $wallet = $wallets->firstWhere("wallet", $request->input("wallet"));

        if (count($wallets) > 1) {
            $wallet->delete();
            return response()->json(['message' => 'Кошелек успешно удален.'], 200);
        }

        return response()->json(['message' => 'Нельзя удалять единственный кошелек.'], 200);
    }
    public function change(Request $request)
    {
        $messages = [
            'percent.integer' => 'Процент должен быть числом.',
            'percent.min' => 'Процент должен быть больше 1.',
            'percent.max' => 'Процент не может быть больше 100.',
            'minWithdrawal.numeric' => 'Вывод должен быть числом.',
            'minWithdrawal.gt' => 'Вывод должен быть больше 0.005.',
        ];
        $request->validate([
            'group_id' => 'required',
            'wallet' => 'required',
        ]);

        $wallets = Sub::all()->firstWhere("group_id", $request->input("group_id"))->wallets;
        $wallet = $wallets->firstWhere("wallet", $request->input("wallet"));

        if ($request->input("minWithdrawal") || $request->input("percent")) {
            if ($request->input("percent")) {
                $request->validate([
                    "percent" => "min:1|max:100|integer",
                ], $messages);

                $wallet->percent = $request->input("percent");
            }
            if ($request->input("minWithdrawal")) {
                $request->validate([
                    "minWithdrawal" => "numeric|gt:0.005",
                ], $messages);

                $wallet->minWithdrawal = $request->input("minWithdrawal");
            }

            $wallet->save();

            return response()->json(['message' => 'Кошелек успешно изменен.'], 200);
        } else {
            return back()->withErrors(["change_error" => "Ошибка при смене кошелька."]);
        }
    }
    public function visual(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
        ]);

        return Sub::all()->where('group_id', $request->input('group_id'))->first()->wallets;
    }
}
