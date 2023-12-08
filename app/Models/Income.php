<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\IncomeBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $guarded = [];

    protected $fillable = [
        'group_id',
        'type',
        'referral_id',
        'daily_amount',
        'diff',
        'hash',
        'unit',
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

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function payout(): BelongsTo
    {
        return $this->belongsTo(Payout::class);
    }

    /* end relations */

    public function newEloquentBuilder($query): IncomeBuilder
    {
        return new IncomeBuilder($query);
    }
}
