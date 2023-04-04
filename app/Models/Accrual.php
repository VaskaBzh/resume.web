<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accrual extends Model
{
    use HasFactory;

    protected $table = 'accruals';

    protected $fillable = [
        'group_id',
        'tickers',
    ];

    public function sub()
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }
}
