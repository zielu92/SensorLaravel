<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    protected $fillable = ['name', 'details', 'lat', 'lon', 'icon_id', 'picture_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function location() {
        return $this->hasMany('App\Location');
    }

    public function picture() {
        return $this->belongsTo('App\Photo');
    }

    public function icon() {
        return $this->belongsTo('App\Photo');
    }

    public function getPlaces() {
        return $this->all();
    }

    public function device() {
        return $this->hasManyThrough('App\Device', 'App\Location');
    }

    public function lastUpdatedDeviceInside() {
            $request = DB::table('places')
                -> join('locations', 'locations.place_id', '=', 'places.id')
                -> join('devices', 'devices.location_id', '=', 'locations.id')
                -> join('sensors', 'sensors.device_id', '=', 'devices.id')
                ->where('devices.isInside', '=' ,1)->where('place_id', '=', $this->id)
                ->orderBy('sensors.id', 'DESC')->limit(1)->get();
            if($request->count() > 0) {
               return $request[0]->device_id;
            } else {
                return null;
            }
    }

    public function lastUpdatedDeviceOutside() {
        $request = DB::table('places')
            -> join('locations', 'locations.place_id', '=', 'places.id')
            -> join('devices', 'devices.location_id', '=', 'locations.id')
            -> join('sensors', 'sensors.device_id', '=', 'devices.id')
            ->where('devices.isInside', '=' ,0)->where('place_id', '=', $this->id)
            ->orderBy('sensors.id', 'DESC')->limit(1)->get();
        if($request->count() > 0) {
            return $request[0]->device_id;
        } else {
            return null;
        }
    }
}
