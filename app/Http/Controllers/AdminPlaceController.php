<?php

namespace App\Http\Controllers;

use App\Location;
use App\Photo;
use App\Place;
use Illuminate\Http\Request;

class AdminPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.place_location.index', [
            'locations'=>Location::paginate(25),
            'places'=>Place::pluck('name', 'id')->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $bgImage = new Photo;
        $logo = new Photo;
        if($file = $request->file('picture')){
            $data['picture_id'] = $bgImage->photoUpload($request->file('picture'), 'bgImage_');
        }
        if($file = $request->file('icon')){
            $data['icon_id'] = $logo->photoUpload($request->file('icon'), 'icon_');
        }

        $newPlace = Place::create($data);
        $newPlace->id;
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }
}
