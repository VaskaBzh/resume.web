<?php

namespace App\Models;

use App\Http\Controllers\Hashes\HashController;
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

    protected static function boot()
    {
        parent::boot();

        static::created(function (Worker $worker) {
            if (!Hash::all()->where('group_id', $worker->group_id)->first()) {
                $sub = Sub::all()->where('group_id', $worker->group_id)->first();
                $sub->hashes()->create([
                    'group_id' => $worker->group_id,
                    'unit' => $worker->unit,
                    'hash' => $worker->hash,
                ]);
            }
        });
    }
}
