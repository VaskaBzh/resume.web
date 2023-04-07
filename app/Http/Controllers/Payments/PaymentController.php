<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class WithdrawalController extends Controller
{
    public function withdraw(Request $request)
    {
        $user = auth()->user();
        $wallet = $request->input('wallet');
        $percentage = $request->input('percentage');
        $minWithdrawalAmount = 0.0001; // Замените на ваше минимальное значение для вывода

        // Рассчитываем сумму для вывода
        $withdrawalAmount = $user->balance * ($percentage / 100);

        // Проверяем, достаточно ли средств для вывода
        if ($user->balance >= $minWithdrawalAmount) {
            $transaction = new Transaction([
                'user_id' => $user->id,
                'wallet' => $wallet,
                'amount' => $withdrawalAmount,
                'status' => 'выплачено',
                'timestamp' => now(),
            ]);

////////////////////////////////////////////////////////////////////////////////////////////////////
            $walletPassword = env('WALLET_PASSWORD');

            // Разблокируйте кошелек перед выполнением выплаты
            $unlockResponse = Http::withBasicAuth('your_rpc_username', 'your_rpc_password')
            ->post('http://92.205.163.43:8332', [
                'jsonrpc' => '1.0',
                'id' => 'unlock_wallet',
                'method' => 'walletpassphrase',
                'params' => [$walletPassword, 60], // Разблокировать на 60 секунд
            ]);

            if (!$unlockResponse->successful()) {
                // Обработка ошибки разблокировки кошелька
            }
////////////////////////////////////////////////////////////////////////////////////////////////////
            // Осуществляем выплату через протокол RPC
            $response = Http::withBasicAuth('your_rpc_username', 'your_rpc_password')
                ->post('http://92.205.163.43:8332', [
                    'jsonrpc' => '1.0',
                    'id' => 'withdrawal',
                    'method' => 'sendtoaddress',
                    'params' => [$wallet, $withdrawalAmount], //Самая важная строчка, в которрой передаем настройки транзакции
                ]);

            if ($response->successful()) {
                $transaction->txid = $response->json()['result'];
                $transaction->save();

                // Обновляем баланс пользователя
                $user->balance -= $withdrawalAmount;
                $user->save();

                return response()->json(['message' => 'Выплата успешно выполнена.']);
            } else {
                return response()->json(['message' => 'Произошла ошибка при выполнении выплаты.']);
            }
        } else {
            // Создаем запись транзакции со статусом "в ожидании"
            $transaction = new Transaction([
                'user_id' => $user->id,
                'wallet' => $wallet,
                'amount' => $withdrawalAmount,
                'status' => 'в ожидании',
                'timestamp' => now(),
            ]);
            $transaction->save();

            return response()->json(['message' => 'Недостаточно средств для вывода. Запрос на вывод отправлен и будет обработан, когда накопится минимальная сумма.']);
        }
    }
}
