<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name', 'location', 'mac'
    ];

    public function id($mac) {
        $device = $this->where('mac','=', $mac)->firstOrFail();
        return $device->id;
    }

    public function sensor() {
        return $this->hasMany('App\Sensor');
    }

    public function lastRecord($name) {
        $name = strtolower($name);
        return $this->sensor->where('valueName', '=', $name)->last()['value'];
    }

    public function lastUpdate($name) {
        $name = strtolower($name);
        return $this->sensor->where('valueName', '=', $name)->last()['created_at'];
    }
}
