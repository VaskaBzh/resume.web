<?php

namespace App\Services\External;

use Illuminate\Support\Facades\Http;

class WalletService
{
    public function __construct()
    {
        $this->client = Http::withBasicAuth(
            username: config('api.wallet.username'),
            password: config('api.wallet.password')
        );
    }

    /**
     * Разблокировать кошелек
     *
     * @param string $wallet - адрес кошелька
     * @param string $bitcoinBalance - баланс кошелька в биткоинах
     * @return bool - подтверждение разблокировки кошелька
     */
    public function unlock(string $wallet, string $limitedBalance): bool
    {
        $response = $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'withdrawal',
            'method' => 'sendtoaddress',
            'params' => [$wallet, $limitedBalance]
        ]);

        return $response->successful();
    }
}
