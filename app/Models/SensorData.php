<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alert; // Import the Alert model

class SensorData extends Model
{
    protected $fillable = ['debit', 'difference', 'client_id'];

    
}
