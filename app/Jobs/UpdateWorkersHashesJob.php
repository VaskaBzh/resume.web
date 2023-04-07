<?php

namespace App\Jobs;

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

        foreach ($workers as $worker) {
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
            $result = [];
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
                    if ($worker->tickers != "" || $worker->tickers != null) {
                        if (isset($worker->tickers)) {
                            $result = array_merge(json_decode($worker->tickers), $result);
                        }
                    }

                    $result[] = [time(), $shares, $unit];

                    $worker->tickers = $result;
                    $worker->save();
                } catch(Exception $e) {
                    // Handle JSON parse error...
                    $this->release(10);
                }
            }
        }
    }
}
