<?php

namespace App\Models;

use App\Builders\WorkerBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'workers';

    protected $fillable = [
        'name',
        'worker_id',
        'group_id',
        'approximate_hash_rate',
        'status',
        'unit',
        'pool_data',
        'deleted_at',
    ];

    protected $casts = [
        'pool_data' => 'array'
    ];

    public function getRouteKeyName(): string
    {
        return 'worker_id';
    }

    public function sub(): BelongsTo
    {
        return $this->belongsTo(
            Sub::class,
            'group_id',
            'group_id'
        );
    }

    public function workerHashrates(): HasMany
    {
        return $this->hasMany(WorkerHashrate::class, 'worker_id', 'worker_id');
    }

    /* Custom builder */

    public function newEloquentBuilder($query): WorkerBuilder
    {
        return new WorkerBuilder($query);
    }
}
