<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index() {
        return view('places',[
            'places'=>Place::all(),
        ]);
    }
}
