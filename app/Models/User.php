<?php

namespace App\Models;

use App\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'referral_code->code',
        'referral_code->group_id',
        'sms',
        'google2fa_secret'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'referral_code' => 'json'
    ];

    public function subs()
    {
        return $this->hasMany(Sub::class);
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(
            Sub::class,
            'referrals',
            'user_id',
            'group_id'
        )
            ->withPivot(
                'id',
                'user_id',
                'group_id',
                'referral_percent'
            )->withTimestamps();
    }

    public function owner(): Attribute
    {
        return Attribute::make(
            get: fn(): ?Sub => $this->owners()->first()
        );
    }

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }
}
