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
                            @if($place->lastUpdatedDeviceInside()!=null)
                                <b>Inside:</b>
                                <p> @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('TEMPERATURE')!="")
                                        Temperature: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('TEMPERATURE')}} °C</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PRESSURE')!="")
                                        Pressure: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PRESSURE')}} hPa</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('LUX')!="")
                                        Light: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('LUX')}} Lux</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PM1')!="")
                                        PM1: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PM1')}} μg/m3</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PM2.5')!="")
                                        PM2.5: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PM2.5')}} μg/m3</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PM10')!="")
                                        PM10: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PM10')}} μg/m3</b><br>
                                    @endif
                                </p>
                            @endif
                            @if($place->lastUpdatedDeviceOutside()!=null)
                                <b>outside:</b>
                                <p> @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('TEMPERATURE')!="")
                                        Temperature: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('TEMPERATURE')}} °C</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PRESSURE')!="")
                                        Pressure: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PRESSURE')}} hPa</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('LUX')!="")
                                        Light: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('LUX')}} Lux</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PM1')!="")
                                        PM1: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PM1')}} μg/m3</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PM2.5')!="")
                                        PM2.5: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PM2.5')}} μg/m3</b><br>
                                    @endif
                                    @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PM10')!="")
                                        PM10: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PM10')}} μg/m3</b><br>
                                    @endif
                                </p>
                            @endif
                            </h5>
                        <p>{{$place->details}}</p>
                        <a href="{{route('location.show', $place->id)}}" class="btn btn-primary float-right">Show more</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last update
                            @if($place->lastUpdatedDeviceInside()!=null) In:
                                <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastRecord('PM10')!="" ? $place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastUpdate('PM10') : $place->device->where('id','=',$place->lastUpdatedDeviceInside())[0]->lastUpdate('PM2.5')}}</b>
                            @endif
                            @if($place->lastUpdatedDeviceOutside()!=null) Out:
                                <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastRecord('PM10')!="" ? $place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastUpdate('PM10') : $place->device->where('id','=',$place->lastUpdatedDeviceOutside())[0]->lastUpdate('PM2.5')}}</b>
                            @endif
                        </small>
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
