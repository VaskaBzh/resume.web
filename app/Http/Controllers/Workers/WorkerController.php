<?php

declare(strict_types=1);

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function visual(Request $request): Collection
    {
        return Worker::where('worker_id', $request->worker_id)->get();
    }
}
