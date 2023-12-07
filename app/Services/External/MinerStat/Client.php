<?php

declare(strict_types=1);

namespace App\Services\External\MinerStat;

use App\Services\External\BaseClient;

class Client extends BaseClient
{
    protected function baseUrl(): string
    {
        return config('api.minerstat.uri');
    }
    
    public static function import()
    {
        $import = [];
        
        foreach (config('api.minerstat.paths') as $path) {
            $import[]
        }
    }
}
