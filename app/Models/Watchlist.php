<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    protected $table = 'watchlist';

    protected $fillable = [
        'name',
        'm_name',
        'type',
        'users_id',
        'users_age',
    ];
}
