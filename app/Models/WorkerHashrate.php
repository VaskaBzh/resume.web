<?php

namespace App\Models;

use App\Http\Controllers\Hashes\HashController;
use App\Http\Controllers\Workers\WorkerController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkerHashrate extends Model
{
    use HasFactory;

    protected $table = 'workers_hashrate';

    protected $fillable = [
        'worker_id',
        'hash',
        'unit',
    ];

    public function getRouteKeyName(): string
    {
        return 'worker_id';
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class, 'worker_id', 'worker_id');
    }
}
