<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\IncomeBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\RedirectResponse;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $guarded = [];

    protected $fillable = [
        'group_id',
        'referral_id',
        'wallet_id',
        'daily_amount',
        'diff',
        'hash',
        'status',
        'message',
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

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    /* end relations */

    /* Создаем кастомный билдер */
    public function newEloquentBuilder($query): IncomeBuilder
    {
        return new IncomeBuilder($query);
    }
}
