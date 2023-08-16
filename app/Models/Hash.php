<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\HashBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hash extends Model
{
    use HasFactory;

    protected $table = 'hashes';

    protected $fillable = [
        'group_id',
        'hash',
        'unit',
        'worker_count',
    ];

    /** Relations */
    public function sub(): BelongsTo
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }

    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class, 'group_id', 'group_id');
    }
    /* end relations */

    /*
     * Создаем кастомный билдер
     */
    public function newEloquentBuilder($query): HashBuilder
    {
        return new HashBuilder($query);
    }
}
