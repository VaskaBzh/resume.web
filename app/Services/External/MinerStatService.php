<?php

declare(strict_types=1);

namespace App\Services\External;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class MinerStatService
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('api.minerstat.uri'));
    }

    /**
     * Возвращает статистику minerstat
     */
    public function getStats(): Collection
    {
        $response = $this->client->get(implode('/', [
            'coins',
        ]), [
            'list' => 'BTC'
        ])->throwIf(fn (Response $response) => $response->clientError() || $response->serverError(),
            new \Exception('Ошибка при выполнении запроса')
        );

        return $response->collect();
    }
}
