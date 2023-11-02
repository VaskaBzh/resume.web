<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\SubBuilder;
use App\Utils\Helper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sub extends Model
{
    use HasFactory;

    protected $primaryKey = 'group_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'referrer_id',
        'sub',
        'pending_amount',
        'total_amount',
        'allbtc_fee',
        'referral_percent',
        'referral_discount',
        'custom_percent_expired_at',
        'created_at',
        'updated_at',
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
        return $this->hasMany(Finance::class, 'group_id');
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(Sub::class, 'referrer_id');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Sub::class, 'referrer_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function watcherLinks(): HasMany
    {
        return $this->hasMany(WatcherLink::class, 'group_id');
    }

    /* Attributes */
    public function totalPayout(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->payouts()->sum('payout')
        );
    }

    public function totalHashRate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this
                ->workers()
                ->onlyActive()
                ->sum('approximate_hash_rate')
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

    /**
     * Прогноз дохода на сегодня
     *
     * @param float $hashPerDay
     * @param float $fee
     * @return string
     */
    public function todayForecast(float $hashPerDay, float $fee): string
    {
        return number_format(Helper::calculateEarn(
            stats: MinerStat::first(),
            hashRate: $hashPerDay,
            fee: $fee
        ), 8, '.', ' ');
    }
}
