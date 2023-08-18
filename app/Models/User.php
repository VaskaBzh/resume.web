<?php

namespace App\Models;

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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
            ->withPivot('code', 'sub_profit_percent', 'user_discount_percent')
            ->withTimestamps();
    }

    public function owner(): Attribute
    {
        return Attribute::make(
            get: fn (): ?Sub => $this->owners()->first()
        );
    }
}
