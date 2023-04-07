<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Denpa\Bitcoin\Client as BitcoinClient;

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
            'scheme'        => 'http',
            'host'          => '92.205.163.43',
            'port'          => 8332,
            'user'          => 'bituser',
            'password'      => '111',
            'ca'            => null,
            'preserve_case' => false,
        ]);

        $fromAddress = "bc1qhntf7tus7tuc07vh629fd8y96jhdysflnzujsl";
        $toAddress = $request->input('to_address');
        $amount = $request->input('amount');

//        $unspentOutputs = $bitcoin->getbalance();
        $balance = json_decode($bitcoin->getbalance());

        if ($balance < $amount) {
            return response()->json(['error' => 'Insufficient balance.']);
        }

        // Send the funds
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

        dd($txid);

        return response()->json(['success' => true, 'txid' => $txid]);
    }
}
