<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function payout(Request $request)
    {
        $sub = Auth::user()->subs()->where('group_id', $request->input('group_id'))->first();
        $address = $request->input('address');
        $percentage = $request->input('percent');
        $balance = $request->input('amount');
        $minWithdrawalAmount = 0.0001; // Замените на ваше минимальное значение для вывода

        $result = [];
        // Проверяем, достаточно ли средств для вывода
        if ($balance >= $minWithdrawalAmount) {
            $transaction = $sub->transactions->first();
            $wallet = $sub->wallet->first();

////////////////////////////////////////////////////////////////////////////////////////////////////
//            $walletPassword = env('WALLET_PASSWORD');
//
//            // Разблокируйте кошелек перед выполнением выплаты
//            $unlockResponse = Http::withBasicAuth('your_rpc_username', 'your_rpc_password')
//            ->post('http://92.205.163.43:8332', [
//                'jsonrpc' => '1.0',
//                'id' => 'unlock_wallet',
//                'method' => 'walletpassphrase',
//                'params' => [$walletPassword, 60], // Разблокировать на 60 секунд
//            ]);
//
//            if (!$unlockResponse->successful()) {
//                // Обработка ошибки разблокировки кошелька
////                return response()->json(['message' => 'Не разблокировано.']);
//            }
////////////////////////////////////////////////////////////////////////////////////////////////////
            // Осуществляем выплату через протокол RPC
            $response = Http::withBasicAuth('bituser', '111')
                ->post('http://92.205.163.43:8332', [
                    'jsonrpc' => '1.0',
                    'id' => 'withdrawal',
                    'method' => 'sendtoaddress',
                    'params' => [$address, $balance], //Самая важная строчка, в которрой передаем настройки транзакции
                ]);

            if ($response->successful()) {
                $result[] = [
                    time(),
                    $address,
                    $balance,
                    $response->json()['result'],
                    $percentage,
                    'completed'
                ];

                if ($transaction->tickers != "" || $transaction->tickers != null) {
                    if (isset($transaction->tickers)) {
                        $result = array_merge($result, json_decode($transaction->tickers));
                    }
                }

                $transaction->tickers = $result;
                $transaction->save();

                // Обновляем баланс пользователя
                if ($wallet->payments == null) {
                    $wallet->payments = $balance;
                } else {
                    $wallet->payments += $balance;
                }
                $wallet->save();

                return response()->json(['message' => 'Выплата успешно выполнена.']);
            } else {
                $result[] = [
                    time(),
                    $address,
                    $balance,
                    "",
                    $percentage,
                    'rejected'
                ];

                if ($transaction->tickers != "" || $transaction->tickers != null) {
                    if (isset($transaction->tickers)) {
                        $result = array_merge($result, json_decode($transaction->tickers));
                    }
                }

                $transaction->tickers = $result;
                $transaction->save();

                return response()->json(['message' => 'Произошла ошибка при выполнении выплаты.']);
            }
        } else {
            return response()->json(['message' => 'Недостаточно средств для вывода. Запрос на вывод отправлен и будет обработан, когда накопится минимальная сумма.']);
        }
    }

    public function getBalance(Request $request)
    {
        return Auth::user()->subs()->where('group_id', $request->input('id'))->first()->transactions->first();
    }
}
