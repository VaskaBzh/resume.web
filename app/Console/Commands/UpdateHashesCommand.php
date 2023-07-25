<?php

namespace App\Console\Commands;

use App\Http\Controllers\Requests\RequestController;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Console\Command;

class UpdateHashesCommand extends Command
{
    protected $signature = 'update:hashes';

    protected $description = 'Command description';

    public function handle(
        BtcComService $btcComService
    ): void
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
            $requestController = new RequestController();

            $data = [
                "group" => $sub->group_id,
                "puid" => "781195",
            ];

            $response_json = $btcComService->getGroup($sub->group_id);

            if (false !== $response_json) {
                try {
                    if ($response_json->data) {
                        $share = $response_json->data->shares_1m;
                        $unit = $response_json->data->shares_unit;
                        $amountWorkers = $response_json->data->workers_active;
                    } else {
                        $share = 0;
                        $unit = "T";
                        $amountWorkers = 0;
                    }

                    $sub->hashes()->create([
                        'group_id' => $sub->group_id,
                        'hash' => number_format($share, 2, ".", ""),
                        'unit' => $unit,
                        'amount' => intval($amountWorkers),
                    ]);
                } catch (Exception $e) {
                    // Обработка ошибки разбора JSON
//                    $this->release(10);
                }
            } else {
                // Обработка ошибки при выполнении запроса
                $this->error('Error fetching data for user: ' . $sub->id);
            }
        }
    }
}
