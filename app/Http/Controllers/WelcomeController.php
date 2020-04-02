<?php

namespace App\Http\Controllers;

use App\Device;
use App\Place;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'devices'=>Device::all(),
            'places'=>Place::all()
        ]);
    }
}