<?php

namespace App\Http\Controllers;

use App\Location;
use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index() {
        return view('places',[
            'places'=>Place::all(),
        ]);
    }

    public function show($id)
    {
        return view('locations',[
            'place'=>Place::findOrFail($id),
            'locations'=>Location::where('place_id', '=', $id)->get(),
        ]);
    }
}
