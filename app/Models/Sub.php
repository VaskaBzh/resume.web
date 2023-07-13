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
        'payments',
        'unPayments',
        'accruals',
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

    public function incomes()
    {
        return $this->hasMany(Income::class, 'group_id', 'group_id');
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'group_id', 'group_id');
    }

//    public function clients()
//    {
//        return $this->hasMany(Client::class);
//    }
}
