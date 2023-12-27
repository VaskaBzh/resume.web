<?php

declare(strict_types=1);

namespace App\Services\Api\MinerStat;

use App\Services\Api\ApiRequest;
use App\Services\Api\BaseClient;
use Illuminate\Support\Collection;

class Client extends BaseClient
{
    private static Collection $imports;

    protected function baseUrl(): string
    {
        return config('api.minerstat.uri');
    }

    public function __invoke(array $properties): Collection
    {
        $paths = config('api.minerstat.paths');

        static::$imports = collect();

        foreach ($properties as $property) {
            if (array_key_exists($property, $paths)) {
                static::$imports->put($property, $this->send(
                    request: ApiRequest::get(config('api.minerstat.paths')[$property])
                )->json());
            }
        }

        return static::$imports;
    }
}
