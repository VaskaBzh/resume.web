<?php

declare(strict_types=1);

namespace App\Console\Commands\Income;

use App\Enums\Income\Type;
use App\Models\Sub;
use App\Services\Internal\IncomeService;
use App\Utils\HashRateConverter;
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
        $subs = Sub::hasWorkerHashRate()
            ->with(['user.referrer', 'wallets'])
            ->get();

        Log::channel('commands.incomes')->info('START INCOME PROCESS');

        $subs->each(static function (Sub $sub) {
            $sub->refresh();

            $referrerActiveSub = $sub->user
                ->referrer
                ?->activeSub()
                ->first();

            $service = IncomeService::init(
                stat: app('miner_stat'),
                sub: $sub,
                referrerSub: $referrerActiveSub
            );

            $service->createIncome($sub, Type::MINING);
            $service->updateLocalSub($sub, Type::MINING);
            $service->createFinance();

            if ($referrerActiveSub) {
                $service->createIncome($referrerActiveSub, Type::REFERRAL);
                $service->updateLocalSub($referrerActiveSub, Type::REFERRAL);
            }
        });

        $totalHashRate = HashRateConverter::fromPure($subs->sum('hash_rate'));

        Log::channel('commands.incomes')
            ->info("FINISH INCOME PROCESS WITH HASH RATE: $totalHashRate->value $totalHashRate->unit");
    }
}
