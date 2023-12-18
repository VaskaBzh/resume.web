<?php

declare(strict_types=1);

namespace App\Services\External\Wallet;

use App\Enums\Income\Message;
use App\Exceptions\PayOutException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// TODO: Refactor to BaseClient implementation
final class Client
{
    public function __construct(
        private PendingRequest $client
    ) {
        $this->client = Http::withBasicAuth(
            username: config('api.wallet.username'),
            password: config('api.wallet.password')
        );
    }

    /**
     * @throws RequestException
     */
    public function unlock(): void
    {
        $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'unlock',
            'method' => 'walletpassphrase',
            'params' => [config('api.wallet.walletpassphrase'), 10],
        ])->throwIf(static fn (Response $response) => $response->clientError() || $response->serverError());
    }

    /**
     * @throws RequestException
     */
    public function lock(): void
    {
        $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'lock',
            'method' => 'walletlock',
        ])->throwIf(static fn (Response $response) => $response->clientError() || $response->serverError());
    }

    /**
     * @throws PayOutException
     */
    public function sendBalance(string $wallet, float $balance): string
    {
        $response = $this->client->post(config('api.wallet.ip'), [
            'jsonrpc' => '1.0',
            'id' => 'withdrawal',
            'method' => 'sendtoaddress',
            'params' => [
                $wallet,
                (float) number_format($balance, 8, '.', ' '),
            ],
        ]);

        Log::channel('payouts')->info('WALLET RESPONSE', [
            'wallet' => $wallet,
            'response' => $response,
        ]);

        if (! $response['result']) {
            throw new PayOutException(Message::ERROR_PAYOUT->value.$response['error']);
        }

        return $response['result'];
    }
}
