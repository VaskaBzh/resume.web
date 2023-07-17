<?php

namespace App\Console\Commands;

use App\Helper;
use App\Http\Controllers\Requests\RequestController;
use App\Models\Income;
use App\Models\Sub;
use Exception;
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

                    $token = config('token.secret_token');

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
     * @return int
     */
    public function handle()
    {
        $subs = Sub::all();
        foreach ($subs as $sub) {
            $requestController = new RequestController();

            $opts = array(
                "http" => array(
                    "method" => "GET",
                    "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                        "Content-Type: application/json; charset=utf-8",
                )
            );
            $context = stream_context_create($opts);
            $url = "https://api.minerstat.com/v2/coins?list=BTC";
            $response_stat = file_get_contents($url, false, $context);

            $response_hash = $requestController->proxy([
                "puid" => "781195",
                "group" => $sub->group_id,
                "page_size" => "1000",
            ], "worker", "get");
            $response_diff = $requestController->proxy([], "pool/status", "get");
//
//            $response_list = $requestController->proxy([
//                "puid" => "781195",
//            ], "worker/groups", "get");
            if (false !== $response_hash) {
                try {
                    $wallets = $sub->wallets;
                    $response_stat_encode = json_decode($response_stat);
                    $response_hash_encode = json_decode($response_hash->getContent());
                    $response_diff_encode = json_decode($response_diff->getContent());
//                    $response_list_encode = json_decode($response_list->getContent());
                    $share = 0;
                    $unit = "T";
                    if ($response_hash_encode->data->data) {
                        $share = array_reduce($response_hash_encode->data->data, function ($carry, $item) {
                            foreach ($item as $key => $value) {
                                if ($key == "shares_1d") {
                                    $carry += floatval($value);
                                }
                            }
                            return $carry;
                        }, $share);
                        $unit = array_reduce($response_hash_encode->data->data, function ($carry, $item) {
                            foreach ($item as $key => $value) {
                                if ($key == "shares_unit") {
                                    $carry["shares_unit"] = $value;
                                }
                            }
                            return $carry;
                        },
                            ['shares_unit' => ''])['shares_unit'];
                    }

                    if ($share > 1) {
                        $earn = Helper::calculateEarn(
                            share: $share,
                            rewardBlock: $response_stat_encode[0]->reward_block,
                            fppsMminingEarnings: $response_diff_encode->data->fpps_mining_earnings,
                            difficulty: $response_stat_encode[0]->difficulty
                        );
                    } else {
                        $earn = 0;
                    }


//                    $earn = $earn * (1 - 0.005);
//                    $earn = $earn * (1 - 0.035);

                    $income = [
                        'group_id' => $sub->group_id,
                        'wallet' => "",
                        'amount' => number_format($earn, 8, ".", ""),
                        'payment' => 0,
                        'percent' => 100,
                        'diff' => $response_stat_encode[0]->difficulty,
                        'unit' => $unit,
                        'hash' => number_format($share, 2, ".", ""),
                        'status' => "rejected",
                        'message' => "",
                        'txid' => "",
                    ];

                    $income["payment"] = $income["amount"] * ($income["percent"] / 100);

                    $sumAccruals = $earn;
                    if ($sub->accruals !== null) {
                        $sumAccruals = $sumAccruals + $sub->accruals;
                    }

                    if ($income["amount"] > 0) {
                        if (count($wallets) === 0) {
                            $this->sendBalance($sub, $income, [], $earn, $sumAccruals);
                        } else {
                            foreach ($wallets as $wallet) {
                                $this->sendBalance($sub, $income, $wallet, $earn, $sumAccruals);
                            }
                        }
                    }
                } catch (Exception $e) {
                    // Обработка ошибки разбора JSON
                    $this->error('Error parsing JSON response for user: ' . $sub->id . ' - ' . $e->getMessage());
                }
            } else {
                // Обработка ошибки при выполнении запроса
                $this->error('Error parsing JSON response for user: ' . $sub->id . ' - ' . $e->getMessage());
            }
        }
    }
}
