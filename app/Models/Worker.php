<?php

namespace App\Models;

use App\Builders\WorkerBuilder;
use App\Http\Controllers\Hashes\HashController;
use App\Http\Controllers\Requests\RequestController;
use App\Http\Controllers\Workers\WorkerController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Worker extends Model
{
    use HasFactory;

    // Указываем, что таблицей для этой модели является 'withdrawals'
    protected $table = 'workers';

    // Защищенные поля, которые могут быть массово присвоены
    protected $fillable = [
        'worker_id',
        'group_id',
        'approximate_hash_rate',
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
