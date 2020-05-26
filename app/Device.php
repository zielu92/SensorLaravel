<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name', 'location', 'mac', 'location_id', 'password', 'isInside'
    ];

    protected  $hidden = ['mac', 'password'];

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
        return optional($this->sensor->where("valueName", 'like', $name)->last())['created_at'];
    }

    public function lastRecordForPlace($location_id, $name) {
        return optional($this->where('location_id', '=', $location_id)->sensor[0]->where('valueName', 'like', $name)->last())['value'];
    }

    public function lastUpdateForPlace($location_id,$name) {
        return optional($this->where('location_id', '=', $location_id)->sensor[0]->where('valueName', 'like', $name)->last())['created_at'];
    }

}
