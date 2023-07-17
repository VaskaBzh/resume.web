<?php

declare(strict_types=1);

namespace App\Services\External;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class MinerStatService
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('api.minerstat.uri'))
            ->withHeaders([
                'Authorization' => config('api.minerstat.token'),
            ]);
    }

    public function getStats(): Response
    {
        $response = $this->client->get(implode('/', [
            'coins',
        ]), [
            'list' => 'BTC'
        ])->throw();
        
        return $response['data'];
    }
}
