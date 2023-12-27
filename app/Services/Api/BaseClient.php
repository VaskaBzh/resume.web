<?php

declare(strict_types=1);

namespace App\Services\Api;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class BaseClient
{
    public function send(ApiRequest $request): Response
    {
        return $this->getBaseRequest()
            ->withHeaders($request->getHeaders())
            ->{$request->getMethod()}(
                $request->getUri(),
                $request->getMethod() === 'get'
                    ? $request->getQuery()
                    : $request->getBody()
            );
    }

    /**
     * Get a base request for the API.
     */
    protected function getBaseRequest(): PendingRequest
    {
        $request = Http::acceptJson()
            ->contentType('application/json')
            ->throw()
            ->baseUrl($this->baseUrl());

        return $this->authorize($request);
    }

    /**
     * Authorize a request for the API.
     */
    protected function authorize(PendingRequest $request): PendingRequest
    {
        return $request;
    }

    /**
     * Get the base URL for the API.
     */
    abstract protected function baseUrl(): string;
}
