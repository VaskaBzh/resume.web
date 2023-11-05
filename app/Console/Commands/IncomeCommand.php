<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Income\Type;
use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Models\Sub;
use Illuminate\Support\Facades\Log;
use App\Services\Internal\IncomeService;
use Illuminate\Console\Command;
use App\Exceptions\IncomeCreatingException;

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
            ->with(['user', 'workers'])
            ->each(static function (Sub $sub) {
                $sub->refresh();

                try {
                    $referrerSub = $sub->user->referrer?->subs->first();

                    $service = (new IncomeService())->init(sub: $sub, referrerSub: $referrerSub);
                    $income = $service->createIncome($sub, Type::MINING);
                    $service->updateLocalSub($sub, Type::MINING);
                    $service->createFinance();

                    if ($referrerSub) {
                        $service->createIncome($referrerSub, Type::REFERRAL);
                        $service->updateLocalSub($referrerSub, Type::REFERRAL);
                    }

                    Log::channel('incomes')
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
