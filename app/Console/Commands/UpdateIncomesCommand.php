<?php

namespace App\Console\Commands;

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
                    $unlock = Http::withBasicAuth('bituser', '111')
                        ->post('http://92.205.163.43:8332', [
                            'jsonrpc' => '1.0',
                            'id' => 'unlock',
                            'method' => 'walletpassphrase',
                            'params' => ['gloom ethics august sample fun submit slow humor seek canvas cannon crystal actress sadness parent smoke hurdle shine pull trip ghost', 60],
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
                        $this->info($balance); // Выводит содержимое ответа
                        $this->info($response->body()); // Выводит содержимое ответа
                        $this->info($response->status()); // Выводит HTTP-статус ответа

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
                            if ($pendingIncomes->count() > 0) {
                                foreach ($pendingIncomes as $pending) {
                                    $pending["status"] = "completed";
                                    $pending->save();
                                }
                            }
                            if ($rejectedIncomes->count() > 0) {
                                foreach ($rejectedIncomes as $pending) {
                                    $pending["status"] = "completed";
                                    $pending->save();
                                }
                            }

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

        $sub->incomes()->create($income);

        $sub->accruals = $sumAccruals;
        $sub->unPayments = $sub->accruals - $sub->payments;
        $sub->save();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Получите список пользователей или другие данные, необходимые для выполнения запроса
        $subs = Sub::all();
        foreach ($subs as $sub) {
            // Выполните запрос для каждого пользователя (или другой необходимой единицы)
            $opts = array(
                "http" => array(
                    "method" => "GET",
                    "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                        "Content-Type: application/json; charset=utf-8",
                )
            );
            $context = stream_context_create($opts);
            $url = "https://api.minerstat.com/v2/coins?list=BTC";
            $response = file_get_contents($url, false, $context);
            $req_url = 'https://pool.api.btc.com/v1/worker?group=' . $sub->group_id . '&puid=781195';
            $response_json = file_get_contents($req_url, false, $context);
            if (false !== $response_json) {
                try {
                    $wallets = $sub->wallets;
                    $responseEncode = json_decode($response);
                    $responseData = json_decode($response_json);
                    if ($responseData->data->data) {
                        $share = 0;
                        $share = array_reduce($responseData->data->data, function ($carry, $item) {
                            foreach ($item as $key => $value) {
                                if ($key == "shares_1d") {
                                    $carry += floatval($value);
                                }
                            }
                            return $carry;
                        }, $share);
                        $unit = array_reduce($responseData->data->data, function ($carry, $item) {
                            foreach ($item as $key => $value) {
                                if ($key == "shares_unit") {
                                    $carry["shares_unit"] = $value;
                                }
                            }
                            return $carry;}, ['shares_unit' => ''])['shares_unit'];
                    } else {
                        $share = 0;
                        $unit = "T";
                    }

                    if ($share > 0) {
                        $earn = ($share * pow(10, 12) * 86400 * $responseEncode[0]->reward_block) / ($responseEncode[0]->difficulty * pow(2,32));
                    } else {
                        $earn = 0;
                    }

                    $earn = $earn * (1 - 0.035 - 0.005);

                    $income = [
                        'group_id' => $sub->group_id,
                        'wallet' => "",
                        'amount' => number_format($earn, 8, ".", ""),
                        'payment' => 0,
                        'percent' => 100,
                        'diff' => $responseEncode[0]->difficulty,
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

                    if (count($wallets) === 0) {
                        $this->sendBalance($sub, $income, [], $earn, $sumAccruals);
                    }

                    foreach ($wallets as $wallet) {
                        if ($income["amount"] > 0) {
                            $this->sendBalance($sub, $income, $wallet, $earn, $sumAccruals);
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
