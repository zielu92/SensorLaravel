<?php

namespace App\Http\Controllers;

use App\Map;
use App\Place;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index($type) {
        $internal = null;
        $external = null;
        foreach(Place::all() as $place) {
            $internal = array();
            //internal devices
            if ($place->lastUpdatedDeviceInside() != null) {
                if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->count()>0) {
                    if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord(strtoupper($type))!="") {
                        $value = round($place->device->where('id', '=', $place->lastUpdatedDeviceInside())->first()->lastRecord(strtoupper($type)));
                        $internal[] = [
                            'lat'=> $place->lat,
                            'lon'=> $place->lon,
                            'id'=> $place->id,
                            'color'=>Map::tagColor($value, $type),
                            'value'=>$value,
                            ];
                    }
                }
            }
            $external = array();
            //external devices
            if ($place->lastUpdatedDeviceOutside() != null) {
                if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->count()>0) {
                    if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord(strtoupper($type))!="") {
                        $value = round($place->device->where('id', '=', $place->lastUpdatedDeviceOutside())->first()->lastRecord(strtoupper($type)));
                        $external[] =  [
                            'lat'=> $place->lat,
                            'lon'=> $place->lon,
                            'id'=> $place->id,
                            'color'=>Map::tagColor($value, $type),
                            'value'=>$value,
                            ];
                    }
                }
            }
        }
        return view('map', [
                'title'=>$type,
                'internalPlaces'=>$internal,
                'externalPlaces'=>$external,
            ]
        );
    }
}
