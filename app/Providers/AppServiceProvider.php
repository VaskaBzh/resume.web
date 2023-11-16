<?php

namespace App\Providers;

use App\Services\External\BtcCom\Client as BtcComClient;
use App\Services\External\BtcCom\DataTransformer as BtcComDataTransformer;
use App\Services\External\ClientContract;
use App\Services\External\TransformContract;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
