<?php

declare(strict_types=1);

namespace App\Console\Commands\Income;

use App\Dto\Income\UpdateStatusData;
use App\Enums\Income\Status;
use App\Exceptions\PayOutException;
use App\Models\Sub;
use App\Services\Internal\IncomeService;
use App\Services\Internal\PayoutService;
use App\Services\Internal\SubService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PayoutCommand extends Command
{
    protected $signature = 'payout';

    protected $description = 'Вывод средств на сервис кошелька';

    public function handle(PayoutService $service): void
    {
        $service->init();
    }
}
