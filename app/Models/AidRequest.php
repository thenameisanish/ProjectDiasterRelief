<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class AidRequest extends Model
{
   protected $fillable = ['requester_name', 'contact_number', 'location', 'resource_needed', 'quantity', 'unit', 'status'];

}