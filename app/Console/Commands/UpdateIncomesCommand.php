<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Events\IncomeCompleteEvent;
use App\Models\Sub;
use App\Services\External\WalletService;
use App\Services\Internal\IncomeService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateIncomesCommand extends Command
{

    protected $signature = 'update:incomes';

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
                walletService: resolve(WalletService::class),
                sub: $sub
            );
        }

        resolve(WalletService::class)->lock();
    }

    private function process(
        IncomeService $incomeService,
        WalletService $walletService,
        Sub           $sub
    ): void
    {
        Log::channel('incomes')
            ->info('INIT UPDATE INCOME PROCESS ' . $sub->sub);

        if (!$incomeService->hasHashRate(sub: $sub)) {
            return;
        }

        $incomeService
            ->setDailyAmount()
            ->sumTotalAmount(totalAmount: $sub->total_amount);

        $wallet = $sub->wallets?->first();

        if ($wallet) {
            if ($incomeService->isLessThenMinWithdraw(accumulatedAmount: $sub->un_payments)) {
                $incomeService
                    ->accumulateAmount($sub->un_payments)
                    ->setMessage(Message::LESS_MIN_WITHDRAWAL)
                    ->setStatus(Status::PENDING)
                    ->createLocalIncome(
                        sub: $sub,
                        wallet: $wallet
                    );

                $incomeService->updateLocalSub(sub: $sub);

                return;
            }

            if ($walletService->unlock()) {

                Log::channel('incomes')->info('WALLET UNLOCKED', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);

                $txId = $walletService->sendBalance(
                    wallet: $wallet,
                    balance: $incomeService->getPayment($sub->un_payments)
                );

                if (!$txId) {
                    Log::channel('incomes')->info('TXID IS EMPTY', [
                        'sub' => $sub->id,
                        'wallet' => $wallet->id
                    ]);

                    $incomeService
                        ->accumulateAmount($sub->un_payments)
                        ->setMessage(Message::ERROR_PAYOUT)
                        ->createLocalIncome($sub, $wallet);

                    $incomeService->updateLocalSub(sub: $sub);
                    $walletService->lock();

                    return;
                }

                $walletService->upsertLocalWallet(
                    wallet: $wallet,
                    payment: $incomeService->getIncomeParam('dailyAmount') + $sub->un_payments
                );

                $incomeService
                    ->setTxId($txId)
                    ->setStatus(Status::COMPLETED)
                    ->setMessage(Message::COMPLETED)
                    ->sumTotalPayment($sub->un_payments, $sub->total_payment)
                    ->clearAccumulatedAmount();

                $incomeService->updateLocalSub(sub: $sub);
                $incomeService->createLocalIncome(sub: $sub, wallet: $wallet);

                event(new IncomeCompleteEvent(sub: $sub, payment: $incomeService->getIncomeParam('dailyAmount')));

                $incomeService->complete(sub: $sub, wallet: $wallet);

                Log::channel('incomes')->info('INCOME COMPLETE', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);
            } else {
                Log::channel('incomes')->info('WALLET UNLOCK ERROR', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);

                $incomeService
                    ->accumulateAmount($sub->un_payments)
                    ->setMessage(Message::ERROR_PAYOUT)
                    ->createLocalIncome(
                        sub: $sub,
                        wallet: $wallet
                    );

                $incomeService->updateLocalSub(sub: $sub);

                $incomeService->setMessage(Message::ERROR);
            }
        } else {
            Log::channel('incomes')->info('WALLET IS NULL', [
                'sub' => $sub->id,
            ]);

            $incomeService
                ->accumulateAmount($sub->un_payments)
                ->setMessage(Message::LESS_MIN_WITHDRAWAL)
                ->setStatus(Status::PENDING)
                ->createLocalIncome(
                    sub: $sub,
                    wallet: $wallet
                );

            $incomeService->updateLocalSub(sub: $sub);
        }

        $walletService->lock();

        Log::channel('incomes')->info('WALLET LOCKED', [
            'sub' => $sub->id,
        ]);

        sleep(1);
    }
}
