<?php

namespace App\Jobs;

use App\Models\Sub;
use App\Models\Worker;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HourlyHashesUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Получите список пользователей или другие данные, необходимые для выполнения запроса
        $subs = Sub::all();
        $maximum_records = 256;

        foreach ($subs as $sub) {
            $extra_records = Sub::where('group_id', $sub->group_id)
                ->oldest('created_at')
                ->offset($maximum_records)
                ->limit(PHP_INT_MAX)
                ->get();

            if ($extra_records->count() > 0) {
                foreach ($extra_records as $extra_record) {
                    $extra_record->delete();
                }
            }

            // Выполните запрос для каждого пользователя (или другой необходимой единицы)
            $opts = array(
                "http" => array(
                    "method" => "GET",
                    "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                        "Content-Type: application/json; charset=utf-8",
                )
            );
            $context = stream_context_create($opts);
            $req_url = 'https://pool.api.btc.com/v1/worker?group=' . $sub->group_id . '&puid=781195';
            $response_json = file_get_contents($req_url, false, $context);
            if (false !== $response_json) {
                try {
                    $responseData = json_decode($response_json);
                    if ($responseData->data->data) {
                        $share = 0;
                        $share = array_reduce($responseData->data->data, function ($carry, $item) {
                            foreach ($item as $key => $value) {
                                if ($key == "shares_1m") {
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

                    $sub->hashes()->create([
                        'group_id' => $sub->group_id,
                        'hash' => number_format($share, 2, ".", ""),
                        'unit' => $unit,
                    ]);
                } catch (Exception $e) {
                    // Обработка ошибки разбора JSON
                    $this->release(10);
                }
            } else {
                // Обработка ошибки при выполнении запроса
                $this->error('Error fetching data for user: ' . $sub->id);
            }
        }
    }
}
