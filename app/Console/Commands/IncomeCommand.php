<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Events\PayoutCompleteEvent;
use App\Models\Sub;
use App\Services\External\WalletService;
use App\Services\Internal\IncomeService;
use Illuminate\Console\Command;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

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
        foreach (Sub::all() as $sub) {
            $this->process(
                incomeService: resolve(IncomeService::class),
                sub: $sub
            );
        }

        //if (config('app.env') === 'production') {
            $this->call('payout');
        //}
    }

    private function process(
        IncomeService $incomeService,
        Sub           $sub
    ): void
    {
        $incomeService->init(sub: $sub);

        if (!$incomeService->hasHashRate()) {
            return;
        }

        $wallet = $sub->wallets?->first();

        if ($wallet) {
            if ($incomeService->isLessThenMinWithdraw()) {
                $incomeService
                    ->setMessage(message: Message::LESS_MIN_WITHDRAWAL)
                    ->setStatus(status: Status::PENDING);

                $incomeService->createLocalIncome(wallet: $wallet);
                $incomeService->createFinance();
                $incomeService->updateLocalSub();

                return;
            }

            $incomeService
                ->setMessage(message: Message::READY_TO_PAYOUT)
                ->setStatus(status: Status::READY_TO_PAYOUT);

            $incomeService->createLocalIncome(wallet: $wallet);
        } else {
            $incomeService
                ->setMessage(Message::LESS_MIN_WITHDRAWAL)
                ->setStatus(Status::PENDING);

            $incomeService->createLocalIncome(wallet: null);
            $incomeService->createFinance();
        }

        $incomeService->updateLocalSub();

        sleep(1);
    }
}
