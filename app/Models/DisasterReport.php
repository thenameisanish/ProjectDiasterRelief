<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisasterReport extends Model
{
    
    protected $fillable = [
        'disaster_type', 
        'description', 
        'latitude', 
        'longitude', 
        'status'
    ];
}