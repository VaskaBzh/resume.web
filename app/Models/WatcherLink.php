<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WatcherLink extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'group_id',
        'token',
        'access_count',
        'allowed_routes',
    ];

    protected $casts = [
        'allowed_routes' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sub(): BelongsTo
    {
        return $this->belongsTo(Sub::class);
    }
}
