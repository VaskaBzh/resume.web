<?php

declare(strict_types=1);

namespace App\Console\Commands\Income;

use App\Enums\Income\Type;
use App\Exceptions\IncomeCreatingException;
use App\Models\Sub;
use App\Services\Internal\IncomeService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class IncomeCommand extends Command
{
    protected $signature = 'income';

    protected $description = 'Обновление базы доходов в 5:00';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Sub::hasWorkerHashRate()
            ->with(['user.referrer', 'wallets'])
            ->each(static function (Sub $sub) {
                $sub->refresh();

                try {
                    $referrerActiveSub = $sub->user
                        ->referrer
                        ?->activeSub()
                        ->first();

                    $service = IncomeService::init(
                        stat: app('miner_stat'),
                        sub: $sub,
                        referrerSub: $referrerActiveSub
                    );

                    $income = $service->createIncome($sub, Type::MINING);
                    $service->updateLocalSub($sub, Type::MINING);
                    $service->createFinance();

                    if ($referrerActiveSub) {
                        $service->createIncome($referrerActiveSub, Type::REFERRAL);
                        $service->updateLocalSub($referrerActiveSub, Type::REFERRAL);
                    }

                    Log::channel('commands.incomes')
                        ->info(message: 'INCOME CREATE', context: $income->toArray());
                } catch (IncomeCreatingException) {
                    return;
                }
            });

        if (config('app.production_env')) {
            $this->call('payout');
        }
    }
}
