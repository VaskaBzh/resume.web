<?php

namespace App\Http\Controllers\Wallets;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Requests\RequestController;
use App\Models\Sub;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class WalletController extends Controller
{
    public function create(Request $request)
    {
        if (app()->getLocale() === 'ru') {
            $messages = [
                'wallet.required' => 'Введите адрес на кошелека',
                'wallet.min' => 'Неправильный адрес кошелька',
                'percent.integer' => 'Процент должен быть числом.',
                'percent.min' => 'Процент должен быть больше 1.',
                'percent.max' => 'Процент не может быть больше 100.',
                'minWithdrawal.numeric' => 'Вывод должен быть числом.',
                'minWithdrawal.gt' => 'Вывод должен быть больше 0.005.',
                'name.min' => 'Имя должно иметь больше трех букв',
            ];
        } else if (app()->getLocale() === 'en') {
            $messages = [
                'wallet.required' => 'Enter the wallet address',
                'wallet.min' => 'Incorrect wallet address',
                'percent.integer' => 'The percentage must be a number.',
                'percent.min' => 'Percentage must be greater than 1.',
                'percent.max' => 'Percentage cannot be more than 100.',
                'minWithdrawal.numeric' => 'Withdrawal must be a number.',
                'minWithdrawal.gt' => 'Withdrawal must be greater than 0.005.',
                'name.min' => 'The name must have more than three letters',
            ];
        }

        $request->validate([
           'group_id' => 'required',
           'wallet' => 'required|min:20',
        ], $messages);

        $percentSum = 0;
        foreach (Wallet::all()->where('group_id', $request->input('group_id')) as $wallet) {
            $percentSum = $percentSum + $wallet->percent;
        }

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

        if ($percentSum + $request->input("percent") > 100) {
            if (app()->getLocale() === 'ru') {
                return back()->withErrors(["create_error" => "Суммарный процент вывода больше 100."]);
            } else if (app()->getLocale() === 'en') {
                return back()->withErrors(["create_error" => "The total percentage of withdrawal is more than 100."]);
            }
        }

        if ($request->input('minWithdrawal')) {
            $request->validate([
                'minWithdrawal' => 'numeric|gt:0.0049',
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
            if (app()->getLocale() === 'ru') {
                return response()->json(['message' => 'Кошелек успешно удален.'], 200);
            } else if (app()->getLocale() === 'en') {
                return response()->json(['message' => 'The wallet has been successfully deleted.'], 200);
            }
        }

        if (app()->getLocale() === 'ru') {
            return response()->json(['message' => 'Нельзя удалять единственный кошелек.'], 200);
        } else if (app()->getLocale() === 'en') {
            return response()->json(['message' => 'You cannot delete the only wallet.'], 200);
        }
    }
    public function change(Request $request)
    {
        if (app()->getLocale() === 'ru') {
            $messages = [
                'percent.integer' => 'Процент должен быть числом.',
                'percent.min' => 'Процент должен быть больше 1.',
                'percent.max' => 'Процент не может быть больше 100.',
                'minWithdrawal.numeric' => 'Вывод должен быть числом.',
                'minWithdrawal.gt' => 'Вывод должен быть больше 0.005.',
                'name.min' => 'Имя должно иметь больше трех букв',
            ];
        } else if (app()->getLocale() === 'en') {
            $messages = [
                'percent.integer' => 'The percentage must be a number.',
                'percent.min' => 'The percentage must be greater than 1.',
                'percent.max' => 'The percentage cannot be more than 100.',
                'minWithdrawal.numeric' => 'The withdrawal must be a number.',
                'minWithdrawal.gt' => 'The withdrawal must be greater than 0.005.',
                'name.min' => 'The name must be more than three letters',
            ];
        }
        $request->validate([
            'group_id' => 'required',
            'wallet' => 'required',
        ]);

        $wallets = Sub::all()->firstWhere("group_id", $request->input("group_id"))->wallets;
        $wallet = $wallets->firstWhere("wallet", $request->input("wallet"));

        $percentSum = -$wallet->percent;
        foreach (Wallet::all()->where('group_id', $request->input('group_id')) as $walletObj) {
            $percentSum = $percentSum + $walletObj->percent;
        }

        if ($percentSum + $request->input("percent") > 100) {
            if (app()->getLocale() === 'ru') {
                return back()->withErrors(["create_error" => "Суммарный процент вывода больше 100."]);
            } else if (app()->getLocale() === 'en') {
                return back()->withErrors(["create_error" => "The total percentage of withdrawal is more than 100."]);
            }
        }

        if ($request->input("minWithdrawal") || $request->input("percent") || $request->input("name")) {
            if ($request->input("percent")) {
                $request->validate([
                    "percent" => "min:1|max:100|integer",
                ], $messages);

                $wallet->percent = $request->input("percent");
            }
            if ($request->input("minWithdrawal")) {
                $request->validate([
                    "minWithdrawal" => "numeric|gt:0.0049",
                ], $messages);

                $wallet->minWithdrawal = $request->input("minWithdrawal");
            }
            if ($request->input("name")) {
                $request->validate([
                    "name" => "min:3",
                ], $messages);

                $wallet->name = $request->input("name");
            }

            $wallet->save();

            if (app()->getLocale() === 'ru') {
                return back()->with('message', 'Кошелек успешно изменен.');
            } else if (app()->getLocale() === 'en') {
                return back()->with('message', 'The wallet has been successfully changed.');
            }
        } else {
            if (app()->getLocale() === 'ru') {
                return back()->withErrors(["change_error" => "Ошибка при смене кошелька."]);
            } else if (app()->getLocale() === 'en') {
                return back()->withErrors(["change_error" => "Error while changing the wallet."]);
            }
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
