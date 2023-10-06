<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_id',
        'reststart',
        'restend'
    ];

    public function time()
    {
    return $this->hasMany(Time::class);
    }
}
