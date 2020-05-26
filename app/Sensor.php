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
            'location_id',
            'device_id',
            'id',
            'id'
        );
    }
}
