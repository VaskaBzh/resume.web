<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Finance extends Model
{
    protected $fillable = [
        'group_id',
        'earn',
        'user_total',
        'percent',
        'profit',
    ];

    public function sub(): BelongsTo
    {
        return $this->belongsTo(
            Sub::class, 
            'group_id',
            'group_id'
        );
    }
}
