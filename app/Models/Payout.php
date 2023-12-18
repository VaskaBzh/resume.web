<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\PayoutBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payout extends Model
{
    protected $fillable = [
        'group_id',
        'wallet_id',
        'payout',
        'txid',
    ];

    /* Relations */

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function sub(): BelongsTo
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }
    /* Custom builder */

    public function newEloquentBuilder($query): PayoutBuilder
    {
        return new PayoutBuilder($query);
    }
}
