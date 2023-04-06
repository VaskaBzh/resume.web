<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayoutController extends Controller
{
    /**
     * Handle the payout process.
     *
     * @return void
     */
    public function payout()
    {
        // Получаем все субаккаунты из базы данных
        $subaccounts = DB::table('subaccounts')->get();

        // Проверяем баланс субаккаунта и выполняем выплату, если баланс больше или равен указанному порогу
        foreach ($subaccounts as $subaccount) {
            if ($subaccount->balance >= 0.05) {
                // Создаем новое соединение RPC-клиента Bitcoin
                $bitcoin = new \Bitcoin\Rpc\Client(
                    config('bitcoin.rpc_user'),
                    config('bitcoin.rpc_password'),
                    config('bitcoin.rpc_host'),
                    config('bitcoin.rpc_port')
                );

                // Отправляем биткоины на указанный адрес из кошелька
                $amount = $subaccount->balance;
                $address = $subaccount->address;
                $minconfirms = 6; // установка количества блоков
                $txid = $bitcoin->sendtoaddress($address, $amount, '', '', true, null, $minconfirms);

                // Обновляем баланс субаккаунта и сохраняем транзакцию в базу данных
                $subaccount->balance = 0;
                $subaccount->save();

                $transaction = new Transaction([
                    'subaccount_id' => $subaccount->id,
                    'amount' => $amount,
                    'address' => $address,
                    'txid' => $txid,
                    'status' => 'Выплачено'
                ]);
                $transaction->save();
            } else {
                // Создаем запись транзакции в базе данных со статусом "Не оплачено"
                $transaction = new Transaction([
                    'subaccount_id' => $subaccount->id,
                    'amount' => $subaccount->balance,
                    'address' => $subaccount->address,
                    'status' => 'Не оплачено'
                ]);
                $transaction->save();
            }
        }
    }
}
