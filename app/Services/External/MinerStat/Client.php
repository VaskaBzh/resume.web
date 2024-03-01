<?php

declare(strict_types=1);

namespace App\Services\External\MinerStat;

use App\Services\External\ApiRequest;
use App\Services\External\BaseClient;
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
