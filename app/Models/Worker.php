<?php

namespace App\Models;

use App\Http\Controllers\Hashes\HashController;
use App\Http\Controllers\Requests\RequestController;
use App\Http\Controllers\Workers\WorkerController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    // Указываем, что таблицей для этой модели является 'withdrawals'
    protected $table = 'workers';

    // Защищенные поля, которые могут быть массово присвоены
    protected $fillable = [
        'worker_id',
        'group_id',
    ];

    public function sub()
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }

    public function worker_hashrate()
    {
        return $this->belongsTo(WorkerHashrate::class, 'worker_id', 'worker_id');
    }

    public function firstHash($worker)
    {
        $requestController = new RequestController();

        $response = $requestController->proxy([
            "puid" => "781195",
            "group" => $worker->group_id,
        ], "worker", "get");

        if (false !== $response) {
            try {
                $shares = 0;
                $unit = "T";
                foreach (json_decode($response->getContent())->data->data as $item) {
                    if ($item->worker_id == $worker->worker_id) {
                        $shares = $item->shares_1m;
                        $unit = $item->shares_unit;
                        break;
                    }
                }

                $worker_hash = new WorkerHashrate([
                    'worker_id' => $worker->worker_id,
                    'hash' => $shares,
                    'unit' => $unit,
                ]);

                $worker_hash->save();

                return $worker_hash;
            } catch (Exception $e) {
                // Обработка ошибки разбора JSON
//                $this->release(10);
                return [
                    'hash' => 0,
                    'unit' => "T",
                    ];
            }
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Worker $worker) {
            if (!Hash::all()->where('group_id', $worker->group_id)->first()) {
                $sub = Sub::all()->where('group_id', $worker->group_id)->first();

                if ($worker->worker_hashrate === null || $worker->worker_hashrate->isEmpty()) {
                    $worker_hash = (new self)->firstHash($worker);
                    $sub->hashes()->create([
                        'group_id' => $worker->group_id,
                        'unit' => $worker_hash->unit,
                        'hash' => $worker_hash->hash,
                    ]);
                }
            }
        });
    }
}
