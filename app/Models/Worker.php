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
        'tickers',
    ];

    public function sub()
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }

    public function hash()
    {
        return $this->belongsTo(Hash::class, 'group_id', 'group_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Worker $worker) {
            $controller = new WorkerController();
            $controller->firstTickers($worker);
        });

        static::created(function (Worker $worker) {
            if (!Hash::all()->where('group_id', $worker->group_id)) {
                $controller = new HashController();
                $controller->firstTickers($worker);
            }
        });
    }
}
