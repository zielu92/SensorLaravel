<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function now(Request $request) {
        $response = array();
        foreach(Device::all() as $device) {
            $response[$device->id]  =  [
                'place' => $device->location->place->name,
                'location' => $device->location->name,
                'Temperature' => $device->lastRecord('TEMPERATURE'),
                'Pressure' => $device->lastRecord('PRESSURE'),
                'Light' => $device->lastRecord('LUX'),
                'PM2.5' => $device->lastRecord('PM2.5'),
                'PM10' => $device->lastRecord('PM10'),
            ];
        }
        return response()->json($response,200);
    }
}
