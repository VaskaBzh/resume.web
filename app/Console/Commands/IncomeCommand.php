<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Models\Sub;
use App\Services\Internal\IncomeService;
use Illuminate\Console\Command;

class IncomeCommand extends Command
{
    protected $signature = 'income';

    protected $description = 'Обновление базы доходов в 5:00';

    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        Sub::hasWorkerHashRate()
            ->with(['user', 'wallets', 'workers'])
            ->each(static function (Sub $sub) {
                $sub->refresh();

                $service = new IncomeService();

                if (!$service->init(sub: $sub)) {
                    return;
                }

                $service->isReadyToPayOut()
                    ? $service->setInfo(
                    message: Message::READY_TO_PAYOUT,
                    status: Status::READY_TO_PAYOUT
                )
                    : $service->setInfo(
                    message: Message::LESS_MIN_WITHDRAWAL,
                    status: Status::PENDING
                );

                $service->createIncome();
                $service->createFinance();
                $service->updateLocalSub();
            });

        if (config('app.production_env')) {
            $this->call('payout');
        }
    }
}
