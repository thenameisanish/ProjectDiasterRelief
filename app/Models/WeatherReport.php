<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherReport extends Model
{
    protected $fillable = [
        'title', 'content', 'image'
    ];
}