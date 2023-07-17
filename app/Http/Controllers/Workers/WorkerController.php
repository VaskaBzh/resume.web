<?php

declare(strict_types=1);

namespace App\Http\Controllers\Workers;

use App\Actions\Worker\Create;
use App\Dto\WorkerData;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerRequest;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function create(WorkerRequest $request)
    {
        Create::execute(
            workerData: WorkerData::fromRequest($request->all())
        );

        return new JsonResponse([
            'success' => true,
            'message' => trans('actions.success_worker_create'),
        ]);
    }

    public function visual(Request $request): Collection
    {
        return Worker::where('worker_id', $request->worker_id)->get();
    }
}
