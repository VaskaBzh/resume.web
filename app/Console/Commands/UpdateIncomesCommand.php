<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Dto\IncomeData;
use App\Helper;
use App\Models\Sub;
use App\Services\External\BtcComService;
use App\Services\External\MinerStatService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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

    private function sendBalance($sub, $income, $wallet, $earn, $sumAccruals)
    {
        if (empty($wallet)) {
            $income["message"] = 'no wallet';
            $income["txid"] = 'no wallet';
        } else {
            if ($wallet->wallet) {
                $income["wallet"] = $wallet->wallet;
                $balance = $earn;
                $min = 0.005;
                $pendingIncomes = $sub->incomes->where("status", "pending");
                $rejectedIncomes = $sub->incomes->where("status", "rejected");

                $balance = $balance + $sub->unPayments;
                if ($wallet->minWithdrawal) {
                    $min = $wallet->minWithdrawal;
                }
                if ($wallet->percent) {
                    $income["percent"] = $wallet->percent;
                }
                $balance = $balance * ($income["percent"] / 100);
                $income["payment"] = $balance;

                if ($balance >= $min) {
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
                        $limitedBalance = number_format($balance, 8, '.', '');
                        $response = Http::withBasicAuth('bituser', '111')
                            ->post('http://92.205.163.43:8332', [
                                'jsonrpc' => '1.0',
                                'id' => 'withdrawal',
                                'method' => 'sendtoaddress',
                                'params' => [$wallet->wallet, $limitedBalance]
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
        }

        $previousIncome = $sub->incomes()
            ->where('group_id', $income['group_id'])
            ->orderByDesc('created_at')
            ->first();

        if ($previousIncome?->created_at->diffInHours(now()) < 12) {
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
        MinerStatService $minerStatService,
        BtcComService    $btcComService,
    )
    {
        $minerStats = $minerStatService->getStats();
        $poolData = $btcComService->getPoolData();

        foreach (Sub::all() as $sub) {
            $workers = $btcComService->getWorkerList(groupId: $sub->group_id);

            if (filled($workers['data'])) {
                $wallets = $sub->wallets;
                $unit = "T";

                $share = array_reduce($workers['data'], function ($carry, $item) {
                    foreach ($item as $key => $value) {
                        if ($key == "shares_1d") {
                            $carry += floatval($value);
                        }
                    }
                    return $carry;
                }, 0);

                $earn = $share > 0
                    ? Helper::calculateEarn(
                        share: $share,
                        rewardBlock: $minerStats->pluck('reward_block')->first(),
                        fppsMminingEarnings: $poolData['fpps_mining_earnings'],
                        difficulty: $minerStats->pluck('difficulty')->first()
                    )
                    : 0;

                $incomeData = IncomeData::fromRequest([
                    'group_id' => $sub->group_id,
                    'wallet' => "",
                    'amount' => number_format($earn, 8, ".", ""),
                    'payment' => number_format($earn, 8, ".", "") * 1,
                    'percent' => 100,
                    'diff' => $minerStats->pluck('difficulty')->first(),
                    'unit' => $unit,
                    'hash' => number_format($share, 2, ".", ""),
                    'status' => "rejected",
                    'message' => "",
                    'txid' => "",
                ]);

                $sumAccruals = $earn;
                if ($sub->accruals !== null) {
                    $sumAccruals = $sumAccruals + $sub->accruals;
                }

                if ($incomeData->amount > 0) {
                    if (count($wallets) === 0) {
                        $this->sendBalance(
                            sub: $sub,
                            income: $incomeData,
                            wallet: [],
                            earn: $earn,
                            sumAccruals: $sumAccruals
                        );
                    } else {
                        foreach ($wallets as $wallet) {
                            $this->sendBalance(
                                sub: $sub,
                                income: $incomeData,
                                wallet: $wallet,
                                earn: $earn,
                                sumAccruals: $sumAccruals
                            );
                        }
                    }
                }
            }
        }
    }
}
