<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    use HasFactory;

    protected $table = 'subs';

    protected $fillable = [
        'user_id',
        'group_id',
        'sub',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workers()
    {
        return $this->hasMany(Worker::class, 'group_id', 'group_id');
    }

    public function hashes()
    {
        return $this->hasMany(Hash::class, 'group_id', 'group_id');
    }

    public function accruals()
    {
        return $this->hasMany(Accrual::class, 'group_id', 'group_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, "sub_id");
    }

    public function wallet()
    {
        return $this->hasMany(Wallet::class, 'group_id', 'group_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($sub) {
            $sub->hashes()->create([]);
            $sub->accruals()->create([]);
            $sub->wallet()->create([]);
        });
    }
}
