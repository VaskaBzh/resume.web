<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Models\Sub;
use App\Services\External\BtcComService;
use App\Services\External\WalletService;
use App\Services\Internal\IncomeService;
use Illuminate\Console\Command;

class UpdateIncomesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:incomes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление базы доходов в 5:00';

    /**
     * Execute the console command.
     *
     */
    public function handle(
        BtcComService $btcComService,
        WalletService $walletService,
    ): void {
        $incomeService = IncomeService::buildWithParams(
            params: $btcComService->getEarnHistory()['list']
        );

        foreach (Sub::all() as $sub) {
            $incomeService->setSub($sub);

            if (!$incomeService->setHashRate()) {
                continue;
            }

            try {
                $earn = $incomeService->getEarn();

                $incomeService
                    ->setIncomeData('amount', $earn)
                    ->setPercent()
                    ->setSubData('payments', $sub->payments)
                    ->setSubData('accruals', $sub->accruals + $earn);
            } catch (\Exception $e) {
                report($e);

                continue;
            }

            $incomeService->setIncomeData('payment', $earn + $sub->unPayments);

            $wallets = $sub->wallets;
            if ($wallets) {
                foreach ($wallets as $wallet) {
                    $incomeService->setWallet($wallet);
                    $incomeService->setIncomeData('payment', ($earn + $sub->unPayments) * ($wallet->percent / 100));
                    $walletService->setWallet($wallet);
//                    !$incomeService->canWithdraw()
                    if (false) {
                        $incomeService->setIncomeData('message', Message::LESS_MIN_WITHDRAWAL->value);
                        $incomeService->setIncomeData('status', Status::PENDING->value);

                        continue;
                    }
//                    $walletService->unlock()
                    if (true) {
                        $txId = "123123123";
//                            $walletService->sendBalance(
//                            balance: $incomeService->getIncomeParam('payment')
//                        );

                        if (!$txId) {
                            $incomeService->setIncomeData('message', Message::ERROR->value);

                            continue;
                        }

                        $incomeService
                            ->setIncomeData('txid', $txId)
                            ->setIncomeData('status', Status::COMPLETED->value)
                            ->setIncomeData('message', Message::COMPLETED->value)
                            ->setSubData('payments', $earn + $sub->unPayments + $sub->payments);

                        $walletService->upsertLocalWallet(
                            payment: $incomeService->getIncomeParam('payment')
                        );

                        $incomeService->complete();
                    } else {
                        $incomeService->setIncomeData('message', Message::ERROR->value);
                    }

                    $walletService->lock();
                }
            } else {
                $incomeService->setIncomeData('message', Message::NO_WALLET->value);
            }

            $incomeService
                ->setSubData('unPayments', $earn + $sub->accruals - ($earn + $sub->unPayments + $sub->payments));

            $incomeService->updateLocalSub();
            $incomeService->createLocalIncome();

            sleep(2);
        }
    }
}
