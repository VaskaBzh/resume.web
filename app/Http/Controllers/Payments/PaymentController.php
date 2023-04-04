<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    protected $rpcUrl;
    protected $rpcUser;
    protected $rpcPassword;

    public function __construct()
    {
        // Установите параметры доступа к RPC-интерфейсу вашего биткоин-кошелька
        $this->rpcUrl = 'http://151.106.39.144:8332';
        $this->rpcUser = 'walletuser';
        $this->rpcPassword = 'E~o4rTE1X1rXW{jRN7VcZp5e3%Ha@7ja3x~h$Cjdjd6Dd~Kl';
    }

    public function getBalance()
    {
        // Сформируйте запрос к RPC-интерфейсу для получения баланса кошелька
        $response = Http::withBasicAuth($this->rpcUser, $this->rpcPassword)
            ->post($this->rpcUrl, [
                'jsonrpc' => '2.0',
                'id' => '1',
                'method' => 'getbalance',
                'params' => []
            ]);

        // Обработайте ответ от RPC-интерфейса
        if ($response->status() === 200) {
            $data = $response->json();
            if (isset($data['result'])) {
                return $data['result'];
            }
        }

        // Если что-то пошло не так, верните ошибку
        return response()->json(['error' => 'Unable to get balance'], 500);
    }

    public function sendPayment(Request $request)
    {
        $toAddress = $request->input('to_address');
        $amount = floatval($request->input('amount'));
//        $feeRate = $request->input('fee_rate'); // параметр комиссии

        // Сформируйте запрос к RPC-интерфейсу для отправки платежа
        $response = Http::withBasicAuth($this->rpcUser, $this->rpcPassword)
            ->post($this->rpcUrl, [
                'jsonrpc' => '2.0',
                'id' => '1',
                'method' => 'sendtoaddress',
                'params' => [$toAddress, (float) $amount, '', '', true, true, '6', 'UNSET']
            ]);

        // Обработайте ответ от RPC-интерфейса
        if ($response->status() === 200) {
            $data = $response->json();
            if (isset($data['result'])) {
                return response()->json(['message' => 'Payment sent']);
            }
        }

        // Если что-то пошло не так, верните ошибку
        return response()->json(['error' => 'Unable to send payment'], 500);
    }
}
