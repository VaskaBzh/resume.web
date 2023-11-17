<?php

namespace App\Providers;

use App\Models\Sub;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WatcherLink;
use App\Policies\SubPolicy;
use App\Policies\WalletPolicy;
use App\Policies\WatcherLinkPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        WatcherLink::class => WatcherLinkPolicy::class,
        Sub::class => SubPolicy::class,
        Wallet::class => WalletPolicy::class,
        User::class => SubPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
