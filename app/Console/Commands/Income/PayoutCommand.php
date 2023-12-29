<?php

declare(strict_types=1);

namespace App\Console\Commands\Income;

use App\Facades\Payout;
use App\Models\Sub;
use Illuminate\Console\Command;

class PayoutCommand extends Command
{
    protected $signature = 'payout';

    protected $description = 'Вывод средств на сервис кошелька';

    public function handle(): void
    {
        //        if (config('app.production_env')) {
        $subs = Sub::readyToPayout()
            ->with('wallets')
            ->get();

        $subs->each(function (Sub $sub) {
            Payout::localSubProcess($sub);
        });
        //        }
    }
}
