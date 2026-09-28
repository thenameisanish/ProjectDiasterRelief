<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReliefMaterial extends Model
{
    protected $fillable = ['name', 'category', 'quantity', 'unit'];
}
