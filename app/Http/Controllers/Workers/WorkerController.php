<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Models\Worker;
use Illuminate\Http\Request;


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

        $this->firstHash($newWorker);

        $sub = Sub::all()->where('group_id', $request->input('group_id'))->first();

        // Сохранение записи в базе данных
        $sub->workers()-> save($newWorker);

        // Возвращение успешного ответа (настроить ответ в соответствии с фронтендом)
        return response()->json([
            'success' => true,
            'message' => 'Воркер создан',
        ], 201);
    }
    public  function firstHash($worker)
    {
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
        if (false !== $response_json) {
            try {
                $shares = 0;
                $unit = "T";
                $responseData = json_decode($response_json, true);
                foreach ($responseData['data']['data'] as $item) {
                    if ($item['worker_id'] == $worker->worker_id) {
                        $shares = $item['shares_1m'];
                        $unit = $item['shares_unit'];
                        break;
                    }
                }

                $worker->hash = $shares;
                $worker->unit = $unit;
                $worker->save();
            } catch (Exception $e) {
                // Обработка ошибки разбора JSON
//                $this->release(10);
            }
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
