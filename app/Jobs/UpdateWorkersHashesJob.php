<?php

namespace App\Jobs;

use App\Http\Controllers\Requests\RequestController;
use App\Models\Sub;
use App\Models\Worker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateWorkersHashesJob implements ShouldQueue
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
        $workers = Worker::all();
        $requestController = new RequestController();
        $maximum_records = 128;
        dump($workers);

        foreach ($workers as $worker) {
            $extra_records = Worker::where('group_id', $worker->group_id)
                ->where('worker_id', $worker->worker_id)
                ->oldest('created_at')
                ->offset($maximum_records)
                ->limit(PHP_INT_MAX)
                ->get();

            if ($extra_records->count() > 0) {
                foreach ($extra_records as $extra_record) {
                    $extra_record->delete();
                }
            }

            $response_json = $requestController->proxy([
                "puid" => "781195",
                "group" => $worker->group_id,
            ], "worker", "get");
            $shares = 0;
            $unit = "T";
            if(false !== $response_json) {
                try {
                    $responseEncode = json_decode($response_json->getContent());
                    foreach ($responseEncode->data->data as $item) {
                        if ($item->worker_id == $worker->worker_id) {
                            $shares = $item->shares_1m;
                            $unit = $item->shares_unit;
                            break;
                        }
                    }
//                    dump($shares);
//                    dump($unit);
//                    dump($worker->worker_id);
//                    dump($worker->group_id);

                    $sub = Sub::where('group_id', $worker->group_id)->first();
                    $sub->workers()->create([
                        'group_id' => $worker->group_id,
                        'worker_id' => $worker->worker_id,
                        'hash' => $shares,
                        'unit' => $unit,
                    ]);
                } catch(Exception $e) {
                    // Handle JSON parse error...
//                    $this->release(10);
                }
            }
        }
    }
}
