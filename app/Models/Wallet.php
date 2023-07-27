<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\WalletBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    public const MIN_BITCOIN_WITHDRAWAL = 0.005;
    public const DEFAULT_PERCENTAGE = 100;

    protected $fillable = [
        'name',
        'group_id',
        'minWithdrawal',
        'name',
        'wallet',
        'payment',
        'percent',
    ];

    protected $casts = [
        'payment' => 'float',
    ];

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
    /* end relations */

    /*
     * Создаем кастомный билдер
    */
    public function newEloquentBuilder($query): WalletBuilder
    {
        return new WalletBuilder($query);
    }


    /* Attributes */

    /**
     * Минимальная выплата в биткоинах
     */
    public function minBitWithdrawal(): Attribute
    {
        return Attribute::make(
            get: fn (): float => $this->minWithdrawal ?? self::MIN_BITCOIN_WITHDRAWAL
        );
    }

    /* end attributes */
}
