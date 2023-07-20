<?php

namespace App\Jobs;

use App\Http\Controllers\Workers\WorkerController;
use App\Models\Sub;
use App\Http\Controllers\Requests\RequestController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class AddWorkerJob implements ShouldQueue
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
        $requestController = new RequestController();
        $responseUngroup = json_decode($requestController->proxy([
            "puid" => "781195",
            "group" => "-1",
            "page_size" => "1000",
        ], "worker")->getContent());

        $subs = Sub::all();


        foreach ($subs as $sub) {
            foreach($responseUngroup->data->data as $worker) {
                if ($this->workerChecker($worker->worker_name, $sub->sub)) {
                    $data = [
                        "puid" => "781195",
                        "group_id" =>  $sub->group_id,
                        "worker_id" => $worker->worker_id,
                    ];
                    $requestController->proxy($data, "worker/update", "post");

                    $workerController = new WorkerController();

                    $workerController->create(new Request($data));
                }
            }
        }
    }


    public function workerChecker($str, $substr) {
        dump($str, $substr);
        $regExp = "/{$substr}/";

        if (preg_match($regExp, $str)) {
            $strArray = explode('.', $str);
            return strlen($strArray[0]) === strlen($substr);
        }

        return false;
    }
}
