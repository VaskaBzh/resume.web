<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\SubBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sub extends Model
{
    use HasFactory;

    protected $primaryKey = 'group_id';

    protected $fillable = [
        'user_id',
        'group_id',
        'sub',
        'pending_amount',
        'total_amount',
        'percent',
    ];

    protected $casts = [
        'pending_amount' => 'float',
        'total_amount' => 'float',
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

    public function referrals(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'referrals',
            'group_id',
            'user_id'
        )
            ->withPivot(
                'id',
                'code',
                'sub_profit_percent',
                'user_discount_percent'
            )->withTimestamps();
    }

    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class, 'group_id');
    }

    public function hashes(): HasMany
    {
        return $this->hasMany(Hash::class, 'group_id');
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class, 'group_id');
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class, 'group_id');
    }

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class, 'group_id');
    }
    /* end relations */

    /* Custom builder */
    public function newEloquentBuilder($query): SubBuilder
    {
        return new SubBuilder($query);
    }

    /* Attributes */

    public function totalPayout(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->payouts()->sum('payout')
        );
    }

    public function yesterdayAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => Income::getYesterDayIncome($this->group_id)
                ->latest()
                ->first()
                ?->daily_amount
        );
    }
}
