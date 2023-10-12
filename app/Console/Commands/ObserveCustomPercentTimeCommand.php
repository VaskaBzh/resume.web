<?php

namespace App\Console\Commands;

use App\Models\Sub;
use Illuminate\Console\Command;

class ObserveCustomPercentTimeCommand extends Command
{
    protected $signature = 'observe:custom-percent-time';

    protected $description = 'Command description';

    public function handle(): void
    {
        Sub::whereNotNull('custom_percent_expired_at')
            ->where('custom_percent_expired_at', '<=', now())
            ->update(['percent' => 3.5, 'custom_percent_expired_at' => null]);
    }
}
