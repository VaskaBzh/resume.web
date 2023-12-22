<?php

declare(strict_types=1);

namespace App\Console\Commands\Income;

use App\Services\Internal\PayoutService;
use Illuminate\Console\Command;

class PayoutCommand extends Command
{
    protected $signature = 'payout';

    protected $description = 'Вывод средств на сервис кошелька';

    public function handle(PayoutService $service): void
    {
        $service->init();
    }
}
