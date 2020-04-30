<?php

namespace App\Http\Controllers;

use App\Device;
use App\Location;
use App\Place;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index($id) {
        $devices = Device::where('location_id', '=', $id)->get();
        $graph = array();
        foreach($devices as $device) {

        }
        return view('devices',[
            'location'=>Location::findOrFail($id),
            'devices'=>$devices,
        ]);
    }
}
