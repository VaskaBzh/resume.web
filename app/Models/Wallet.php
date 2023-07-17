<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\WalletBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'name',
        'group_id',
        'minWithdrawal',
        'wallet',
        'percent',
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
}
