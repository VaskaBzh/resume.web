<?php

namespace App\Jobs;

use App\Actions\WorkerHashRate\BulkDelete;
use App\Http\Controllers\Requests\RequestController;
use App\Models\Sub;
use App\Models\Worker;
use App\Models\WorkerHashrate;
use App\Services\External\BtcComService;
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


}
