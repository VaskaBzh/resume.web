<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Models\Wallet;
use Illuminate\Http\Client\RequestException;
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
     * @throws RequestException
     */
    public function unlock(): void
    {
        $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'unlock',
            'method' => 'walletpassphrase',
            'params' => [config('api.wallet.walletpassphrase'), 10],
        ])->throwIf(static fn (Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса разблокировки кошелька')
        );
    }

    public function lock(): void
    {
        $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'lock',
            'method' => 'walletlock',
        ])->throwIf(static fn (Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса блокировки кошелька')
        );
    }

    /**
     * Отправить баланс в сервис кошелька
     *
     * @param  float  $balance - баланс кошелька
     */
    public function sendBalance(Wallet $wallet, float $balance): ?string
    {
        $response = $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'withdrawal',
            'method' => 'sendtoaddress',
            'params' => [
                $wallet->wallet,
                (float) number_format($balance, 8, '.', ' '),
            ],
        ]);

        info('WALLET RESPONSE', [
            'wallet' => $wallet->id,
            'response' => $response,
        ]);

        return $response['result'];
    }
}
