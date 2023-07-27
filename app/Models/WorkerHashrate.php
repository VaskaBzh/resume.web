<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\WorkerHashRateBuilder;
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

    /* Custom builder */

    public function newEloquentBuilder($query): WorkerHashRateBuilder
    {
        return new WorkerHashRateBuilder($query);
    }

    /* Custom builder */

    public function newEloquentBuilder($query): WorkerHashRateBuilder
    {
        return new WorkerHashRateBuilder($query);
    }
}
