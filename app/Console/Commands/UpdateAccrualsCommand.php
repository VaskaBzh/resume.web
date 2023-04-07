<?php

namespace App\Console\Commands;

use App\Models\Accrual;
use App\Models\User;
use App\Models\Sub;
use Exception;
use Illuminate\Console\Command;

class UpdateAccrualsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:accruals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление базы начислений в 5:00';

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
                    $accrual = $sub->accruals->first();
                    $responseEncode = json_decode($response);
                    $responseData = json_decode($response_json);
                    $result = [];
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
                    $earn = $earn - $earn * 0.035 - $earn * 0.0175;
                    $result[] = [
                        time(),
                        number_format($share, 2, ".", ""),
                        $unit,
                        number_format($earn, 8, ".", ""),
                        $responseEncode[0]->difficulty
                    ];
                    if ($accrual->tickers != "" || $accrual->tickers != null) {
                        if (isset($accrual->tickers)) {
                            $result = array_merge($result, json_decode($accrual->tickers));
                        }
                    }
                    $accrual->tickers = $result;
                    $accrual->save();
                    $sum = 0;
                    foreach ($result as $item) {
                        $sum = $sum + floatval($item[3]);
                    }
                    $sub->wallet->first()->accruals = $sum;
                    $sub->wallet->first()->save();
                } catch (Exception $e) {
                    // Обработка ошибки разбора JSON
                    $this->error('Error parsing JSON response for user: ' . $sub->id);
                }
            } else {
                // Обработка ошибки при выполнении запроса
                $this->error('Error fetching data for user: ' . $sub->id);
            }
        }
    }
}
