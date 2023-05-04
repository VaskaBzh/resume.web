<?php

namespace App\Jobs;

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
        $maximum_records = 256;

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

            $opts = array(
                "http" => array(
                    "method" => "GET",
                    "header" => "Authorization: sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N\r\n" .
                        "Content-Type: application/json; charset=utf-8",
                )
            );
            $context = stream_context_create($opts);
            $req_url = 'https://pool.api.btc.com/v1/worker?group=' . $worker->group_id . '&puid=781195';
            $response_json = file_get_contents($req_url, false, $context);
            $shares = 0;
            $unit = "T";
            if(false !== $response_json) {
                try {
                    $responseData = json_decode($response_json, true);
                    foreach ($responseData['data']['data'] as $item) {
                        if ($item['worker_id'] == $worker->worker_id) {
                            $shares = $item['shares_1m'];
                            $unit = $item['shares_unit'];
                            break;
                        }
                    }

                    $sub = Sub::where('group_id', $worker->group_id)->first();
                    $sub->workers()->create([
                        'group_id' => $worker->group_id,
                        'worker_id' => $worker->worker_id,
                        'hash' => $shares,
                        'unit' => $unit,
                    ]);
                } catch(Exception $e) {
                    // Handle JSON parse error...
                    $this->release(10);
                }
            }
        }
    }
}
