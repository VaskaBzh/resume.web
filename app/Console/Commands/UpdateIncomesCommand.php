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

            if (in_array($sub->group_id, [])) {
                continue;
            }

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

        $incomeService
            ->setSub($sub);

        if (!$incomeService->setHashRate()) {
            return;
        }

        try {
            $amount = $incomeService->getUserAmount();

            $incomeService
                ->setAmount($amount)
                ->setSubAccruals($amount)
                ->setPayment($amount)
                ->setSubUnPayments($amount)
                ->setPercent()
                ->setSubPayments()
                ->updateLocalSub();

        } catch (\Exception $e) {
            report($e);

            return;
        }

        $wallet = $sub->wallets?->first();

        if ($wallet) {
            $incomeService
                ->setWallet($wallet)
                ->calculatePayment();

            $walletService->setWallet($wallet);

            if (false) {


            }

            if (true) {

                Log::channel('incomes')->info('WALLET UNLOCKED', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);

                $txId = "123";
//                    $walletService->sendBalance(
//                    balance: $incomeService->getIncomeParam('payment')
//                );

                if (!$txId) {

                    Log::channel('incomes')->info('TXID IS EMPTY', [
                        'sub' => $sub->id,
                        'wallet' => $wallet->id
                    ]);

                    $incomeService
                        ->setMessage(Message::ERROR_PAYOUT)
                        ->createLocalIncome();

                    $walletService->lock();

                    return;
                }

                $incomeService
                    ->setTxId($txId)
                    ->setStatus(Status::COMPLETED)
                    ->setMessage(Message::COMPLETED)
                    ->setSubPayments($amount)
                    ->clearUnPayments()
                    ->updateLocalSub();

                $walletService->upsertLocalWallet(
                    payment: $incomeService->getIncomeParam('payment')
                );

                event(new IncomeCompleteEvent(sub: $sub, payment: $incomeService->getIncomeParam('payment')));

                $incomeService->complete();

                Log::channel('incomes')->info('INCOME COMPLETE', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);
            } else {
                Log::channel('incomes')->info('WALLET UNLOCK ERROR', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);

                $incomeService->setMessage(Message::ERROR);
            }

            $incomeService->createLocalIncome();

        } else {
            $incomeService
                ->setMessage(Message::NO_WALLET)
                ->setPercent()
                ->createLocalIncome();
        }

        $walletService->lock();

        Log::channel('incomes')->info('WALLET LOCKED', [
            'sub' => $sub->id,
        ]);

        sleep(1);
    }
}
