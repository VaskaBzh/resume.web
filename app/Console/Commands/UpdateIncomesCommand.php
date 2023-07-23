<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Income\Create;
use App\Actions\Sub\Update;
use App\Actions\Wallet\Upsert;
use App\Dto\IncomeData;
use App\Dto\SubData;
use App\Dto\WalletData;
use App\Helper;
use App\Models\Income;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\BtcComService;
use App\Services\External\MinerStatService;
use App\Services\External\WalletService;
use App\Services\Internal\IncomeService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Message;
use Status;

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

    private function sendBalance($sub, $income, $wallet, $sumAccruals)
    {
        if ($wallet->wallet) {
            $income["wallet"] = $wallet->wallet;
            $pendingIncomes = $sub->incomes->where("status", "pending");
            $rejectedIncomes = $sub->incomes->where("status", "rejected");

            if ($wallet->percent) {
                $income["percent"] = $wallet->percent;
            }

            $income["payment"] = $income['payment'] * ($income["percent"] / 100);

            if ($income["payment"] >= $wallet->min_bit_withdrawal) {
                $token = config('api.wallet.walletpassphrase');

                info('Secret token dump', [
                    'token' => $token
                ]);

                $unlock = Http::withBasicAuth('bituser', '111')
                    ->post('http://92.205.163.43:8332', [
                        'jsonrpc' => '1.0',
                        'id' => 'unlock',
                        'method' => 'walletpassphrase',
                        'params' => [$token, 60],
                    ]);

                info('Unlock info', [
                    'Unlock' => $unlock
                ]);

                if ($unlock->successful()) {
//                    $limitedBalance = number_format($balance, 8, '.', '');
                    $response = Http::withBasicAuth('bituser', '111')
                        ->post('http://92.205.163.43:8332', [
                            'jsonrpc' => '1.0',
                            'id' => 'withdrawal',
                            'method' => 'sendtoaddress',
                            'params' => [$wallet->wallet, $income['payment']]
                        ]);

                    if ($response->successful()) {
                        $income["status"] = 'completed';
                        $income["txid"] = $response->json()['result'];
                        $wallet["payment"] = $balance;

                        $sumPayments = $balance;
                        if ($sub->payments !== null) {
                            $sumPayments = $sumPayments + $sub->payments;
                        }
                        $sub->payments = $sumPayments;
                        $wallet->save();
                        $sub->save();

                        $this->completer($pendingIncomes);
                        $this->completer($rejectedIncomes);

                        $income["message"] = 'completed';
                    } else {
                        $income["message"] = 'error payout';
                    }
                    Http::withBasicAuth('bituser', '111')
                        ->post('http://92.205.163.43:8332', [
                            'jsonrpc' => '1.0',
                            'id' => 'lock',
                            'method' => 'walletlock',
                        ]);
                } else {
                    // Обработка ошибки разблокировки кошелька
                    $income["message"] = 'error';
                }
            } else {
                $income["message"] = 'less minWithdrawal';
                $income["status"] = "pending";
            }
        }


        $previousIncome = $sub->incomes()
            ->where('group_id', $income['group_id'])
            ->latest();

        if ($previousIncome) {
            if ($previousIncome?->created_at->diffInHours(now()) > 12) {
                $sub->incomes()->create($income);
            }
        } else {
            $sub->incomes()->create($income);
        }


        $sub->accruals = $sumAccruals;
        $sub->unPayments = $sub->accruals - $sub->payments;
        $sub->save();
    }

    public function completer($incomes)
    {
        if ($incomes->count() > 0) {
            foreach ($incomes as $pending) {
                $pending["status"] = "completed";
                $pending["message"] = "completed";
                $pending->save();
            }
        }
    }

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

            if (!$incomeService->setHashRate($sub)) {

                continue;
            }

            try {
                $earn = $incomeService->getEarn();

                $incomeService
                    ->setData('group_id', $sub->group_id)
                    ->setData('amount', $earn)
                    ->setData('payment', $earn * 100);

                dd($incomeService->getParams());
            } catch (\Exception $e) {
                report($e);

                continue;
            }

            $sumAccruals = $sub->accruals + $earn;
            $wallets = $sub->wallets;
            $payment = $earn + $sub->unPayments;

            if ($wallets) {
                foreach ($wallets as $wallet) {

                    if ($payment < $wallet->min_bit_withdrawal) {
                        continue;
                    }

                    try {
                        $walletService->unlock();

                        $txId = $walletService->sendBalance(
                            walletUid: $wallet->wallet,
                            balance: Helper::calculateBalance(
                                payment: $payment,
                                percent: $wallet->percent
                            )
                        );

                        Upsert::execute(
                            walletData: WalletData::fromRequest([
                                'walletAddress' => $wallet->wallet,
                                'group_id' => $wallet->group_id,
                                'payment' => $payment
                            ])
                        );

                        $walletService->lock();
                    } catch (\Exception $e) {
                        report($e);
                        $incomeData = array_merge($requestData, ['message' => Message::ERROR]);
                    }
                }

            }

            $incomeData['message'] = 'no wallet';

            $this->sendBalance(
                sub: $sub,
                income: $incomeData,
                wallet: new Wallet(),
                sumAccruals: $sumAccruals
            );

//            $previousIncome = Sub::where('group_id', $incomeData['group_id'])
//                ->incomes()
//                ->latest();
//
//            if ($previousIncome) {
//                $previousIncome->created_at->diffInHours(now()) > 12
//                    ? Create::execute(
//                    incomeData: IncomeData::fromRequest(array_merge([
//                        'wallet' => $wallet->wallet,
//                        'diff' => $difficulty,
//                    ]))
//                )
//                    : info('INCOME', $income);
//            } else {
//                $sub->incomes()->create($income);
//            }

            sleep(2);
        }
    }
}
