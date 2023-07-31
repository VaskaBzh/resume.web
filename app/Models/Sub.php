<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\SubBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sub extends Model
{
    use HasFactory;

    protected $table = 'subs';

    protected $fillable = [
        'user_id',
        'group_id',
        'sub',
        'payments',
        'unPayments',
        'accruals',
        'percent',
    ];

    protected $casts = [
        'accruals' => 'float',
        'payments' => 'float',
        'unPayments' => 'float',
    ];

    public function getRouteKeyName(): string
    {
        return 'group_id';
    }

    /* Relations */
    public function finances(): HasMany
    {
        return $this->hasMany(Finance::class, 'group_id', 'group_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class, 'group_id', 'group_id');
    }

    public function hashes(): HasMany
    {
        return $this->hasMany(Hash::class, 'group_id', 'group_id');
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class, 'group_id', 'group_id');
    }

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class, 'group_id', 'group_id');
    }
    /* end relations */

    /* Custom builder */
    public function newEloquentBuilder($query): SubBuilder
    {
        return new SubBuilder($query);
    }

    /* Attributes */

    public function dailyHashRate(): Attribute
    {

        return Attribute::make(
            get: function () {

                dd($this->workers()->with('workerHashrates'));
            }
        );
    }
}
