<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name', 'location', 'mac', 'location_id', 'password', 'isInside'
    ];

    public function id($mac) {
        $device = $this->where('mac','=', $mac)->firstOrFail();
        return $device->id;
    }

    public function sensor() {
        return $this->hasMany('App\Sensor');
    }

    public function  location() {
        return $this->belongsTo('App\Location');
    }

    public function lastRecord($name) {
        return optional($this->sensor->where('valueName', 'like', $name)->last())['value'];
    }

    public function lastUpdate($name) {
        return $this->sensor->where("valueName", 'like', $name)->last()['created_at'];
    }
}
