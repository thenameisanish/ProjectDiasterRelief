<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissingPerson extends Model
{
    protected $fillable = ['name', 'age', 'gender', 'image', 'last_seen_location', 'status'];
}
