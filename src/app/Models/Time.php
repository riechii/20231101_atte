<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start',
        'end'
    ];

    public function user()
    {
    return $this->hasMany(User::class);
    }
}
