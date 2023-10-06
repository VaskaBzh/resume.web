<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\WalletBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    public const MIN_BITCOIN_WITHDRAWAL = 0.005;

    protected $fillable = [
        'name',
        'group_id',
        'minWithdrawal',
        'name',
        'wallet',
        'percent',
        'wallet_updated_at',
    ];

    protected $casts = [
        'wallet_updated_at' => 'date'
    ];

    public function getRouteKeyName(): string
    {
        return 'wallet';
    }

    /*
     * Relations
    */
    public function sub(): BelongsTo
    {
        return $this->belongsTo(
            Sub::class,
            'group_id',
            'group_id'
        );
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    /* end relations */

    /*
     * Создаем кастомный билдер
    */
    public function newEloquentBuilder($query): WalletBuilder
    {
        return new WalletBuilder($query);
    }

    public function totalPayout(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->payouts()->sum('payout')
        );
    }

    public function isUnlocked(): bool
    {
        return now() > $this->wallet_updated_at->addDay();
    }
}
