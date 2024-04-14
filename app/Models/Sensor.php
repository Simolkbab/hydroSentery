<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public function sensorData()
    {
        return $this->hasMany(SensorData::class);
    }
    use HasFactory;
}
