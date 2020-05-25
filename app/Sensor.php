<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = ['device_id', 'name', 'valueName', 'value'];

    public function device() {
        return $this->belongsTo('App\Device');
    }
    public function location()
    {
        return $this->hasManyThrough(
            'App\Location',
            'App\Device',
            'location_id', // Foreign key on users table...
            'device_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
}
