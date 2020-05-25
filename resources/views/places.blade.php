@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Places</h1>
        </div>
    </div>
    <div class="row">
        <div class="card-deck col-md-12">
        @foreach($places as $place)
            <div class="col-md-4 pb-4">
                <div class="card">
                    <div id="card__image" style=' background-image: url("{{$place->picture!=null ? url($place->picture->path) : asset('img/kmutt.jpg') }}");'>
                        <div id="black-opacity"></div>
                        <div class="card-img-overlay">
                            <div id="place-wrapper">
                                <img src="{{$place->icon!=null ? url($place->icon->path) : asset('img/logo.png') }}" alt="{{$place->name}}" id="place__image">
                                <h4 class="card-title text-white d-inline-block font-weight-bold">{{$place->name}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5>
{{--                            @if(\App\Device::lastRecordForPlace($place->id, "TEMPERATURE")!="")--}}
{{--                               {{\App\Device::lastRecordForPlace($place->id, "TEMPERATURE")}}--}}
{{--                            @endif--}}
                            PM2.5 PM10</h5>
                        <p>{{$place->details}}</p>
                        <a href="{{route('location.show', $place->id)}}" class="btn btn-primary float-right">Show graph</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last update</small>
                    </div>
                </div>
            </div>
        @endforeach
            <!-- <div class=" col-lg-6 col-md-6 col-sm-12">
                <a href="{{route('location.show', $place->id)}}" class="card">
                    <div class="card__head">
                        <div class="card__image" style=' background-image: url("{{$place->picture!=null ? url($place->picture->path) : asset('img/kmutt.jpg') }}");'></div>
                        <div class="card__place">
                            <div class="place">
                                <img src="{{$place->icon!=null ? url($place->icon->path) : asset('img/logo.png') }}" alt="{{$place->name}}" class="place__image">
                                <div class="place__content">
                                    <p class="place__header">{{$place->name}}</p>
                                    <p class="place__subheader">Locations: {{$place->location()->count()}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card__body">
                        <h2 class="card__headline">TEMP PM2.5 PM10</h2>
                        <p class="card__text">{{$place->details}}</p>
                        <p class="card__text">Last update</p>
                    </div>
                    <div class="card__foot">
                        <span class="card__link">Read more</span>
                    </div>
                    <div class="card__border"></div>
                </a>
            </div> -->
        </div>
    </div>
@endsection
