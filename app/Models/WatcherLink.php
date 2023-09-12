<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WatcherLink extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'access_count',
        'allowed_views',
    ];

    protected $casts = [
        'allowed_views' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
