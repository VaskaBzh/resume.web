<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sub extends Model
{
    use HasFactory;

    protected $table = 'subs';

    protected $fillable = [
        'user_id',
        'group_id',
        'sub',
        'name',
        'payments',
        'unPayments',
        'accruals',
    ];

    public function user(): BelongsTo
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
