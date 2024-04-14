<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Client extends  Authenticatable{
    

    public function alerts()
    {
        return $this->belongsToMany(Alert::class);
    }
    use HasFactory;
    protected $fillable = [
        'client_id',
        'email',
        'nomClient',
        'telephone',
        'password',
    ];


    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'client_id' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            // Check if photo_path is empty, then set the default value
            if (empty($client->photo_path)) {
                $client->photo_path = 'profile_photos/default_profile.png';
            }
        });
    }

}