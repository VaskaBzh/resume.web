<?php

namespace App\Services\External;

use App\Actions\Wallet\Upsert;
use App\Dto\WalletData;
use App\Models\Wallet;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WalletService
{
    private Wallet $wallet;

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
     * @return bool
     * @throws RequestException
     * @throw \Exception - бросаем исключение, если ошибка запроса
     */
    public function unlock(): bool
    {
        return $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'unlock',
            'method' => 'walletpassphrase',
            'params' => [config('api.wallet.walletpassphrase'), 60]
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса разблокировки кошелька')
        )->successful();
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
     * @param float $balance - баланс кошелька
     */
    public function sendBalance(float $balance): string
    {
        $response = $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'withdrawal',
            'method' => 'sendtoaddress',
            'params' => [$this->wallet->wallet, $balance]
        ])->throwIf(fn(Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса зачисления на кошелек')
        );

        return $response['result'];
    }

    public function setWallet(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function upsertLocalWallet(float $payment): void
    {
        Upsert::execute(
            walletData: WalletData::fromRequest([
                'walletAddress' => $this->wallet->wallet,
                'group_id' => $this->wallet->group_id,
                'payment' => $payment
            ])
        );
    }
}
