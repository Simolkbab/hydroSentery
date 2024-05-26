<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{

  
    protected $fillable = ['client_id', 'message'];


    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }


}
