<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\SubBuilder;
use App\Enums\Worker\Status;
use App\Utils\Helper;
use App\ValueObjects\HashRate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sub extends Model
{
    use HasFactory;

    protected $primaryKey = 'group_id';

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'sub',
        'pending_amount',
        'total_amount',
        'allbtc_fee',
        'custom_percent_expired_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
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

    public function watcherLinks(): HasMany
    {
        return $this->hasMany(WatcherLink::class, 'group_id');
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
            get: fn () => $this->payouts()->sum('payout')
        );
    }

    /**
     * Total hash rate per 24 h
     */
    public function hashRate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this
                ->workers()
                ->byStatus(Status::ACTIVE->value)
                ->sum('approximate_hash_rate')

        );
    }

    /**
     * Convert value and unit
     */
    public function convertedHashRate(): Attribute
    {
        return Attribute::make(
            get: fn () => HashRate::from(value: $this->workers()
                ->byStatus(Status::ACTIVE->value)
                ->sum('approximate_hash_rate')
            )
        );
    }

    public function yesterdayAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => Income::getYesterDayIncome($this->group_id)
                ->latest()
                ->first()
                ?->daily_amount
        );
    }

    /**
     * Прогноз дохода на сегодня
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
