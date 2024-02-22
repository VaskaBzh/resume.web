<?php

namespace App\Console\Commands\Sub;

use App\Models\Sub;
use Illuminate\Console\Command;

class ObserveCustomPercentTimeCommand extends Command
{
    protected $signature = 'observe:custom-percent-time';

    protected $description = 'Command description';

    public function handle(): void
    {
        Sub::whereExpiredCustomPercent()
            ->update(['allbtc_fee' => 3.5, 'custom_percent_expired_at' => null]);
    }
}