<?php

namespace App\Models;

use App\Http\Controllers\Hashes\HashController;
use App\Http\Controllers\Workers\WorkerController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerHashrate extends Model
{
    use HasFactory;

    protected $table = 'workers_hashrate';

    protected $fillable = [
        'worker_id',
        'hash',
        'unit',
    ];

    public function worker()
    {
        return $this->hasMany(Worker::class, 'worker_id', 'worker_id');
    }
}
