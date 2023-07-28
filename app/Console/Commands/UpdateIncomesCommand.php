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
                ->setIncomeData('amount', $amount)
                ->setIncomeData('payment', $amount + $sub->unPayments)
                ->setSubData('payments', $sub->payments)
                ->setSubData('accruals', $sub->accruals + $amount)
                ->setSubUnPayments()
                ->updateLocalSub();
        } catch (\Exception $e) {
            report($e);

            return;
        }

        $wallet = $sub->wallets?->first();

        if ($wallet) {
            $incomeService
                ->setWallet($wallet)
                ->setPercent()
                ->setIncomeData('payment', ($amount + $sub->unPayments) * ($wallet->percent / 100));

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
                    ->setIncomeData('status', Status::COMPLETED->value)
                    ->setIncomeData('message', Message::COMPLETED->value)
                    ->setSubData('payments', $sub->unPayments + $sub->payments)
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
