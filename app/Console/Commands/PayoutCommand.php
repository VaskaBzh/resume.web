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

class PayoutCommand extends Command
{
    protected $signature = 'payout';

    protected $description = 'Вывод средств на сервис кошелька';

    public function handle(): void
    {
        foreach (Sub::withWallets()->get() as $sub) {
            $this->process(
                incomeService: resolve(IncomeService::class),
                walletService: resolve(WalletService::class),
                sub: $sub
            );
        }
    }

    public function process(
        IncomeService $incomeService,
        WalletService $walletService,
        Sub           $sub
    ): void
    {
        $wallet = $sub
            ->wallets
            ->first();

        try {
            $walletService->unlock();
            Log::channel('incomes')->info('WALLET UNLOCKED', [
                'sub' => $sub->id,
                'wallet' => $wallet->id
            ]);

            $txId = $walletService->sendBalance(
                wallet: $wallet,
                balance: $incomeService->getPayout()
            );

            if (!$txId) {
                Log::channel('incomes')->info('TXID IS EMPTY', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);

                $incomeService
                    ->setMessage(message: Message::ERROR_PAYOUT);

                $incomeService->createFinance();
                $incomeService->createLocalIncome(wallet: $wallet);
                $incomeService->updateLocalSub();

                $walletService->lock();

                return;
            }

            $incomeService
                ->setTxId($txId)
                ->setStatus(Status::COMPLETED)
                ->setMessage(Message::COMPLETED)
                ->clearPendingAmount();

            event(new PayoutCompleteEvent(
                sub: $sub,
                wallet: $wallet,
                payout: $incomeService->getPayout(),
                txId: $txId
            ));

            $incomeService->updateLocalSub();
            $incomeService->createFinance();
            $incomeService->createLocalIncome(wallet: $wallet);

            $incomeService->complete(wallet: $wallet);

        } catch (RequestException) {
            Log::channel('incomes')->info('WALLET UNLOCK ERROR', [
                'sub' => $sub->id,
                'wallet' => $wallet->id
            ]);

            $incomeService
                ->setMessage(Message::ERROR_PAYOUT);

            $incomeService->createFinance();
            $incomeService->updateLocalSub();
            $incomeService->createLocalIncome(wallet: $wallet);
        }

        $walletService->lock();

        Log::channel('incomes')->info('WALLET LOCKED', [
            'sub' => $sub->id,
        ]);
    }
}
