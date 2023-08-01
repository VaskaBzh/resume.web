<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Events\IncomeCompleteEvent;
use App\Models\Sub;
use App\Services\External\BtcComService;
use App\Services\External\WalletService;
use App\Services\Internal\IncomeService;
use Illuminate\Console\Command;

class UpdateIncomesCommand extends Command
{

    protected $signature = 'update:incomes';

    protected $description = 'Обновление базы доходов в 5:00';

    /**
     * Execute the console command.
     *
     */
    public function handle(
        BtcComService $btcComService
    ): void
    {

        try {
            $params = $btcComService->getEarnHistory()['list'];
        } catch (\Exception $e) {
            report($e);

            return;
        }

        foreach (Sub::all() as $sub) {
            if ($sub->group_id == 6002482) {
                continue;
            }
            $this->process(
                incomeService: IncomeService::buildWithParams(
                    params: $params
                ),
                walletService: resolve(WalletService::class),
                sub: $sub
            );
        }

        resolve(WalletService::class)->lock();

        info('WALLET LOCKED', [
            'sub' => $sub->id,
        ]);
    }

    private function process(
        IncomeService $incomeService,
        WalletService $walletService,
        Sub           $sub
    ): void
    {
        info('INIT UPDATE INCOME PROCESS ' . $sub->sub);

        $incomeService
            ->setSub($sub);

        if (!$incomeService->setHashRate()) {
            return;
        }

        try {
            $amount = $incomeService->getUserAmount();

            $incomeService
                ->setAmount($amount)
                ->setSubClearPayments()
                ->setSubAccruals($amount)
                ->setSubUnPayments();
        } catch (\Exception $e) {
            report($e);

            return;
        }

        $incomeService
            ->setPayment($amount)
            ->updateLocalSub();

        $wallet = $sub->wallets?->first();

        if ($wallet) {
            $incomeService
                ->setWallet($wallet)
                ->setPercent()
                ->calculatePayment($amount);

            $walletService->setWallet($wallet);

            if (!$incomeService->canWithdraw()) {
                $incomeService
                    ->setIncomeData('message', Message::LESS_MIN_WITHDRAWAL->value)
                    ->setIncomeData('status', Status::PENDING->value)
                    ->createLocalIncome();

                return;
            }

            if ($walletService->unlock()) {

                info('WALLET UNLOCKED', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);

                $txId = $walletService->sendBalance(
                    balance: $incomeService->getIncomeParam('payment')
                );

                if (!$txId) {

                    info('TXID IS EMPTY', [
                        'sub' => $sub->id,
                        'wallet' => $wallet->id
                    ]);

                    $incomeService
                        ->setIncomeData('message', Message::ERROR_PAYOUT->value)
                        ->createLocalIncome();

                    return;
                }

                $incomeService
                    ->setIncomeData('txid', $txId)
                    ->setStatus(Status::COMPLETED)
                    ->setMessage(Message::COMPLETED)
                    ->setSubPayments()
                    ->setSubUnPayments()
                    ->updateLocalSub();

                $walletService->upsertLocalWallet(
                    payment: $incomeService->getIncomeParam('payment')
                );

                event(new IncomeCompleteEvent(sub: $sub, payment: $incomeService->getIncomeParam('payment')));

                $incomeService->complete();

                info('INCOME COMPLETE', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);
            } else
            {
                info('WALLET UNLOCK ERROR', [
                    'sub' => $sub->id,
                    'wallet' => $wallet->id
                ]);

                $incomeService->setIncomeData('message', Message::ERROR->value);
            }

            $incomeService->createLocalIncome();

        } else {
            $incomeService
                ->setIncomeData('message', Message::NO_WALLET->value)
                ->setPercent()
                ->createLocalIncome();
        }

        sleep(1);
    }
}
