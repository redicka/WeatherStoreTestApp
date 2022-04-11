<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherHistory extends Model
{
    use HasFactory;


    protected $dateFormat = 'U';

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    protected $fillable = ['temp'];

}
