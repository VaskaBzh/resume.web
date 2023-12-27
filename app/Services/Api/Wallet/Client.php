<?php

declare(strict_types=1);

namespace App\Services\Api\Wallet;

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
        try {
            Log::channel('commands.payouts')->info('Sending balance', [
                'wallet' => $wallet,
                'balance' => $balance,
            ]);

            $formattedBalance = (float) number_format($balance, 8, '.', '');

            // Логирование перед отправкой запроса
            Log::channel('commands.payouts')->info('Preparing to send request to wallet API', [
                'wallet' => $wallet,
                'formattedBalance' => $formattedBalance,
            ]);

            $response = $this->client->post(config('api.wallet.ip'), [
                'jsonrpc' => '1.0',
                'id' => 'withdrawal',
                'method' => 'sendtoaddress',
                'params' => [$wallet, $formattedBalance],
            ]);

            // Полученный ответ
            Log::channel('commands.payouts')->info('Received wallet API response', [
                'wallet' => $wallet,
                'response' => $response,
            ]);

            if (!isset($response['result']) || $response['result'] === null) {
                Log::channel('commands.payouts')->error('Error in wallet API response', [
                    'wallet' => $wallet,
                    'response' => $response,
                ]);
                throw new PayOutException(Message::ERROR_PAYOUT->value . ($response['error'] ?? 'Unknown error'));
            }

            // Успешное завершение операции
            Log::channel('commands.payouts')->info('Successfully sent balance', [
                'wallet' => $wallet,
                'transactionId' => $response['result'],
            ]);

            return $response['result'];
        } catch (\Exception $e) {
            // Исключения
            Log::channel('commands.payouts')->error('Exception in sendBalance', [
                'wallet' => $wallet,
                'balance' => $balance,
                'exception' => $e->getMessage(),
            ]);
            throw $e; // Переброс исключения для обработки на более высоком уровне
        }
    }

}
