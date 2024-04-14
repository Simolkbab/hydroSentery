<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
    use HasFactory;
}
