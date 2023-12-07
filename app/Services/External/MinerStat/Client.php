<?php

declare(strict_types=1);

namespace App\Services\External\MinerStat;

use App\Services\External\ApiRequest;
use App\Services\External\BaseClient;
use Illuminate\Support\Collection;

class Client extends BaseClient
{
    protected function baseUrl(): string
    {
        return config('api.minerstat.uri');
    }

    private function import(array $properties): Collection
    {
        $paths = config('api.minerstat.paths');

        $imports = collect();

        foreach ($properties as $property) {
            if (array_key_exists($property, $paths)) {
                $imports->put($property, $this->send(
                    request: ApiRequest::get(config('api.minerstat.paths')[$property])
                )->json());
            }
        }

        return $imports;
    }

    public function getImport(array $properties): Collection
    {
        return $this->import($properties);
    }
}
