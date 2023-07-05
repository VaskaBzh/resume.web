<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class WorkerController extends Controller
{

    public function create(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'group_id' => 'required|string',
            'worker_id' => 'required|string',
        ]);

        $newWorker = new Worker([
            'group_id' => $request->input('group_id'),
            'worker_id' => $request->input('worker_id')
        ]);

        $newWorker->save();

        // Возвращение успешного ответа (настроить ответ в соответствии с фронтендом)
        if (App::getLocale() === 'ru') {
            return response()->json([
                'success' => true,
                'message' => 'Воркер создан',
            ]);
        } else if (App::getLocale() === 'en') {
            return response()->json([
                'success' => true,
                'message' => 'The worker is created.',
            ]);
        }
    }


    public function visual(Request $request)
    {
        $request->validate([
            'worker_id' => 'required',
        ]);

        return Worker::all()->where('worker_id', $request->input('worker_id'));
    }
}
