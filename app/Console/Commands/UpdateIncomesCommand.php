<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Helper;
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
    )
    {
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
                    ->setIncomeData('group_id', $sub->group_id)
                    ->setIncomeData('amount', $earn)
                    ->setPayment($earn)
                    ->setPercent()
                    ->setSubData('accruals', $sub->accruals + $earn);
            } catch (\Exception $e) {
                report($e);

                continue;
            }

            $wallets = $sub->wallets;

            if ($wallets) {
                foreach ($wallets as $wallet) {
                    $incomeService->setWallet($wallet);
                    $walletService->setWallet($wallet);

                    if (!$incomeService->canWithdraw()) {
                        $incomeService->setIncomeData('message', Message::LESS_MIN_WITHDRAWAL->value);
                        $incomeService->setIncomeData('status', Status::PENDING->value);
                    }

                    if ($walletService->unlock()) {
                        $txId = $walletService->sendBalance(
                            balance: $incomeService->getIncomeParam('payment')
                        );

                        if (!$txId) {
                            $incomeService->setIncomeData('message', Message::ERROR->value);
                        }

                        $incomeService
                            ->setIncomeData('txid', $txId)
                            ->setIncomeData('status', Status::COMPLETED->value)
                            ->setIncomeData('message', Message::COMPLETED->value);

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

            $incomeService->updateLocalSub();
            $incomeService->createLocalIncome();

            sleep(2);
        }
    }
}
