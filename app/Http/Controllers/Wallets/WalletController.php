<?php

declare(strict_types=1);

namespace App\Http\Controllers\Wallets;

use App\Actions\Wallet\Create;
use App\Actions\Wallet\Delete;
use App\Dto\WalletData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\CreateRequest;
use App\Http\Requests\Wallet\DeleteRequest;
use App\Models\Sub;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function create(CreateRequest $request): JsonResponse
    {
        $walletData = WalletData::fromRequest($request->all());

        if (Wallet::isExceeded(
            groupId: $walletData->groupId,
            percent: $walletData->percent
        )) {
            return response()->json([
                'errors' => [
                    'create_error' => [trans('actions.validation_percent_exceeded')]
                ]
            ], 422);
        }

        Create::execute($walletData);

        return response()->json([
            'success' => [
                'create_success' => [trans('actions.wallet_create')]
            ],
        ]);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $walletData = WalletData::fromRequest($request->all());
        if (Wallet::isLast($walletData->groupId)) {
            return response()->json(['message' => trans('actions.wallet_prevent_last_delete')]);
        }

        Delete::execute(
            wallet: Wallet::getByAddress(address: $walletData->walletAddress)->first()
        );

        return response()->json(['message' => trans('actions.wallet_delete')]);
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
                return response()->json(['message' => 'Кошелек успешно изменен.'], 200);
            } else if (app()->getLocale() === 'en') {
                return response()->json(['message' => 'The wallet has been successfully changed.'], 200);
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
