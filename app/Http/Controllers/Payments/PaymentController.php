<?php

namespace App\Http\Controllers;

use App\Models\Subaccount;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AutomaticPayoutController extends Controller
{
    public function payout()
    {
        // Получаем все субаккаунты из базы данных
        $subaccounts = Subaccount::all();

        foreach ($subaccounts as $subaccount) {
            // Проверяем баланс субаккаунта
            if ($subaccount->balance >= config('app.payout_threshold')) {
                // Проводим выплату
                $result = $this->makePayment($subaccount->bitcoin_address, $subaccount->balance);

                if ($result) {
                    // Обновляем баланс субаккаунта
                    $subaccount->balance = 0;
                    $subaccount->save();

                    // Создаем запись транзакции в базе данных со статусом "выплачено"
                    $transaction = new Transaction();
                    $transaction->subaccount_id = $subaccount->id;
                    $transaction->amount = $subaccount->balance;
                    $transaction->status = 'выплачено';
                    $transaction->save();
                }
            } else {
                // Создаем запись транзакции в базе данных со статусом "не оплачено"
                $transaction = new Transaction();
                $transaction->subaccount_id = $subaccount->id;
                $transaction->amount = $subaccount->balance;
                $transaction->status = 'не оплачено';
                $transaction->save();
            }
        }
    }

    private function makePayment($bitcoinAddress, $amount)
    {
        // Логика для проведения выплаты на кошелек $bitcoinAddress
        // Возвращает true при успешной выплате, false при ошибке
        // Получаем данные о холодном кошельке
        $cold_wallet = ColdWallet::first();
        $rpc_user = $cold_wallet->rpc_user;
        $rpc_password = $cold_wallet->rpc_password;
        $rpc_port = $cold_wallet->rpc_port;
        $rpc_host = $cold_wallet->rpc_host;

        // Создаем новое соединение RPC-клиента Bitcoin
        $bitcoin = new Bitcoin($rpc_user, $rpc_password, $rpc_host, $rpc_port);

        // Проверяем баланс на кошельке
        $balance = $bitcoin->getbalance();

        if ($balance >= $amount) {
            // Отправляем биткоины на указанный адрес
            $txid = $bitcoin->sendtoaddress($address, $amount);

            // Возвращаем true, чтобы показать, что выплата произведена успешно
            return true;
        } else {
            // Возвращаем false, чтобы показать, что выплата не произведена из-за нехватки средств
            return false;
        }
    }
}
