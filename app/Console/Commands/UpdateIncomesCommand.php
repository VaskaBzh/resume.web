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

            try {
//                $walletService->unlock();

                Log::channel('incomes')->info('WALLET UNLOCKED', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);

                $txId = '123'; /*$walletService->sendBalance(
                    wallet: $wallet,
                    balance: $incomeService->getPayout()
                );*/

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
        } else {
            $incomeService
                ->setMessage(Message::LESS_MIN_WITHDRAWAL)
                ->setStatus(Status::PENDING);

            $incomeService->createLocalIncome(null);
            $incomeService->createFinance();
            $incomeService->updateLocalSub();
        }

        $walletService->lock();

        Log::channel('incomes')->info('WALLET LOCKED', [
            'sub' => $sub->id,
        ]);

        sleep(1);
    }
}
