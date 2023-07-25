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
use function PHPUnit\Framework\isEmpty;

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
        BtcComService $btcComService
    ): void
    {

        $params = $btcComService->getEarnHistory()['list'];

        foreach (Sub::all() as $sub) {
            $this->process(
                incomeService: IncomeService::buildWithParams(
                    params: $params
                ),
                walletService: resolve(WalletService::class),
                sub: $sub
            );
        }
    }

    private function process(
        IncomeService $incomeService,
        WalletService $walletService,
        Sub           $sub
    )
    {
        $incomeService
            ->setSub($sub);

        if (!$incomeService->setHashRate()) {
            return;
        }

        try {
            $earn = $incomeService->getEarn();

            $incomeService
                ->setIncomeData('amount', $earn)
                ->setSubData('payments', $sub->payments)
                ->setSubData('accruals', $sub->accruals + $earn);
        } catch (\Exception $e) {

            report($e);

            return;
        }

        $incomeService->setIncomeData('payment', $earn + $sub->unPayments);

        $wallets = $sub->wallets;

        if (filled($wallets)) {
            foreach ($wallets as $wallet) {
                $incomeService
                    ->setWallet($wallet)
                    ->setPercent()
                    ->setIncomeData('payment', 0.0001);
//                    ($earn + $sub->unPayments) * ($wallet->percent / 100)
                $walletService->setWallet($wallet);
//                    !$incomeService->canWithdraw()
                if (false) {
                    $incomeService
                        ->setIncomeData('message', Message::LESS_MIN_WITHDRAWAL->value)
                        ->setIncomeData('status', Status::PENDING->value)
                        ->createLocalIncome();

                    continue;
                }
//                    $walletService->unlock()
                if (true) {
                    $txId = $walletService->sendBalance(
                        balance: $incomeService->getIncomeParam('payment')
                    );

                    if (!$txId) {
                        $incomeService
                            ->setIncomeData('message', Message::ERROR->value)
                            ->createLocalIncome();

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
                $incomeService->createLocalIncome();
            }
        } else {
            $incomeService->setIncomeData('message', Message::NO_WALLET->value);
            $incomeService
                ->setPercent()
                ->createLocalIncome();
        }

        $walletService->lock();

        $incomeService
            ->setSubData('unPayments', $earn + $sub->accruals - ($earn + $sub->unPayments + $sub->payments));

        $incomeService->updateLocalSub();

        sleep(1);
    }
}
