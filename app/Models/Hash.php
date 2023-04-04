<?php

namespace App\Models;

use App\Http\Controllers\Hashes\HashController;
use App\Jobs\HourlyHashesUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
    use HasFactory;

    protected $table = 'hashes';

    protected $fillable = [
        'group_id',
        'tickers',
    ];
    public function sub()
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }
    public function workers()
    {
        return $this->hasMany(Worker::class, 'group_id', 'group_id');
    }
}
