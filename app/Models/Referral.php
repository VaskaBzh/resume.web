<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Referral extends Model
{
    protected $fillable = [
        'user_id',
        'owner_group_id',
        'code',
        'owner_profit_percent',
        'referral_discount_percent',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    /* Relations */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sub(): BelongsTo
    {
        return $this->belongsTo(Sub::class, 'owner_group_id', 'group_id');
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    /* end relations */
}
