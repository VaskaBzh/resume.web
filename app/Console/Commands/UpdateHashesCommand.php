<?php

declare(strict_types=1);

namespace App\Console\Commands;

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

        $subs = Sub::all();

        foreach ($subs as $sub) {

            /**
             * Записывать данные хеша за пероод в два месяца
             *
             * старые удалять
             *
             */
            if ($extra_records->count() > 0) {
                foreach ($extra_records as $extra_record) {
                    $extra_record->delete();
                }
            }

            $response_json = $btcComService->getGroup($sub->group_id);

            if (false !== $response_json) {
                try {
                    if ($response_json->data) {
                        $hashRate = $response_json->data->shares_1m;
                        $unit = $response_json->data->shares_unit;
                        $amountWorkers = $response_json->data->workers_active;
                    } else {
                        $hashRate = 0;
                        $unit = "T";
                        $amountWorkers = 0;
                    }

                    $sub->hashes()->create([
                        'group_id' => $sub->group_id,
                        'hash' => number_format($hashRate, 2, ".", ""),
                        'unit' => $unit,
                        'amount' => intval($amountWorkers),
                    ]);
                } catch (\Exception $e) {
                    // Обработка ошибки разбора JSON
//                    $this->release(10);
                }
            } else {
                // Обработка ошибки при выполнении запроса
                $this->error('Error fetching data for user: ' . $sub->id);
            }

            sleep(1);
        }
    }
}
