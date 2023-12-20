<?php

declare(strict_types=1);

namespace App\Providers;

use App\Exceptions\CalculatingException;
use App\Models\MinerStat;
use App\Services\External\BtcCom\Client as BtcComClient;
use App\Services\External\BtcCom\ClientContract;
use App\Services\External\BtcCom\DataTransformer as BtcComDataTransformer;
use App\Services\External\BtcCom\TransformContract;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientContract::class, BtcComClient::class);
        $this->app->bind(TransformContract::class, BtcComDataTransformer::class);
        $this->app->singleton('miner_stat', function () {
            if (! $stats = MinerStat::first()) {
                throw new CalculatingException('Miner stat is empty');
            }

            return $stats;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
