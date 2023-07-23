<?php

namespace App\Services\External;

use Illuminate\Http\Client\Response;
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
     * @throw \Exception - бросаем исключение, если ошибка запроса
     */
    public function unlock(): void
    {
        $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'unlock',
            'method' => 'walletpassphrase',
            'params' => [config('api.wallet.walletpassphrase'), 60]
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса разблокировки кошелька')
        );
    }

    public function lock(): void
    {
        $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'lock',
            'method' => 'walletlock',
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса блокировки кошелька')
        );
    }

    /**
     * Отправить баланс в сервис кошелька
     * @param string $walletUid - Номер кошелька
     * @param float $balance - баланс кошелька
     */
    public function sendBalance(string $walletUid, float $balance): string
    {
        $response = $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'withdrawal',
            'method' => 'sendtoaddress',
            'params' => [$walletUid, $balance]
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса зачисления на кошелек')
        );

        return $response['result'];
    }
}
