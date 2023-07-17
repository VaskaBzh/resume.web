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
        'wallet',
        'amount',
        'payment',
        'percent',
        'diff',
        'unit',
        'hash',
        'status',
        'message',
        'txid',
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

    /* Создаем кастомный билдер */
    public function newEloquentBuilder($query): IncomeBuilder
    {
        return new IncomeBuilder($query);
    }
}
