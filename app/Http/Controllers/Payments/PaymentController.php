<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Denpa\Bitcoin\Client as BitcoinClient;;

class PaymentController extends Controller
{
    /**
     * Handle the payout process.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function payout(Request $request)
    {
        $bitcoin = new BitcoinClient([
            'scheme' => 'http',
            'rpc_user' => 'bituser',
            'rpc_password' => '111',
            'rpc_host' => '92.205.163.43',
            'rpc_port' => '8332',
        ]);

        $fromAddress = "bc1qhntf7tus7tuc07vh629fd8y96jhdysflnzujsl";
        $toAddress = $request->input('to_address');
        $amount = $request->input('amount');

        $balance = $bitcoin->getbalance($fromAddress);

        if ($balance < $amount) {
            return response()->json(['error' => 'Insufficient balance.']);
        }

        $txid = $bitcoin->sendtoaddress($toAddress, $amount);

//        $transaction = new Transaction([
//            'sub_id' => Auth::user()->group_id,
//            'amount' => $request->input("amount"),
//            'wallet_address' => $request->input("address"),
////                   'txid' => $txid,
//            'status' => 'Выплачено'
//        ]);
//        dump($txid);
//        $transaction->save();

        return response()->json(['success' => true, 'txid' => $txid]);
    }
//    {
//        // Получаем все субаккаунты из базы данных
//        $subaccounts = Sub::all();
//
//        // Проверяем баланс субаккаунта и выполняем выплату, если баланс больше или равен указанному порогу
//        foreach ($subaccounts as $subaccount) {
////            if ($subaccount->walelts()->first()->accruals >= 0.05) {
//                // Создаем новое соединение RPC-клиента Bitcoin
//                $bitcoin = new Client(
//                    config('bitcoin.rpc_user'),
//                    config('bitcoin.rpc_password'),
//                    config('bitcoin.rpc_host'),
//                    config('bitcoin.rpc_port')
//                );
//
//                $minconfirms = 6; // установка количества блоков
//                $txid = $bitcoin->sendtoaddress($request->input("address"), $request->input("amount"), '', '', true, [], $minconfirms);
//
//                // Обновляем баланс субаккаунта и сохраняем транзакцию в базу данных
//                $subaccount->wallets()->first()->balance = 0;
//                $subaccount->save();
//
//                $transaction = new Transaction([
//                    'sub_id' => $subaccount->group_id,
//                    'amount' => $request->input("amount"),
//                    'wallet_address' => $request->input("address"),
////                    'txid' => $txid,
//                    'status' => 'Выплачено'
//                ]);
//                dump($txid);
//                $transaction->save();
////            } else {
//                // Создаем запись транзакции в базе данных со статусом "Не оплачено"
////                $transaction = new Transaction([
////                    'sub_id' => $subaccount->id,
////                    'amount' => $request->input("amount"),
////                    'wallet_address' => $request->input("address"),
////                    'status' => 'Не оплачено'
////                ]);
////                $transaction->save();
////            }
//        }
//    }
}
