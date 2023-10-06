<?php

namespace App\Models;

use App\Actions\User\DeleteConfirmationCode;
use App\Builders\UserBuilder;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory,
        Notifiable,
        HasRoles,
        HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'referral_code',
        'phone',
        'sms',
        'google2fa_secret',
        'confirmation_code',
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
    ];

    /* Relations */
    public function subs(): HasMany
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

    public function watcherLinks(): HasMany
    {
        return $this->hasMany(WatcherLink::class);
    }

    /* End relations */

    /* Attributes */

    public function owner(): Attribute
    {
        return Attribute::make(
            get: fn(): ?Sub => $this->owners()->first()
        );
    }

    public function generateConfirmationCode(): string
    {
        $min = pow(10, 5 - 1);
        $max = pow(10, 5) - 1;

        return (string) mt_rand($min, $max);
    }

    public function confirmationCode(): Attribute
    {
        return Attribute::make(
            get: function (?string $confirmationCode): ?string {

                DeleteConfirmationCode::execute($this);

                return $confirmationCode;
            }
        );
    }

    public function isEmailAllowed(): bool
    {
        return now()->gt($this->email_verified_at->addHours(48));
    }

    /* End attributes */

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification(
            actionRoute: 'v1.verification.verify',
        ));
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new VerifyEmailNotification(
            actionRoute: 'v1.password.reset.verify',
        ));
    }

    /* Custom builder */
    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }
}
