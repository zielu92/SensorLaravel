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
                            @if($place->lastUpdatedDeviceInside()!=null)
                                @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->count()>0)
                                    <h5>Inside Sensor:</h5>
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('TEMPERATURE')!="")
                                            <p class="m-0">Temperature: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('TEMPERATURE')}} °C</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PRESSURE')!="")
                                            <p class="m-0">Pressure: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PRESSURE')}} hPa</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('LUX')!="")
                                            <p class="m-0">Light: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('LUX')}} Lux</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM1')!="")
                                            <p class="m-0">PM1: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM1')}} μg/m3</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM2.5')!="")
                                            <p class="m-0">PM2.5: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM2.5')}} μg/m3</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM10')!="")
                                            <p class="m-0">PM10: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM10')}} μg/m3</b></p>
                                        @endif
                                @endif
                            @endif
                            @if($place->lastUpdatedDeviceOutside()!=null)
                                @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->count()>0)
                                    <h5>Outside Sensor:</h5>
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('TEMPERATURE')!="")
                                            <p class="m-0">Temperature: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('TEMPERATURE')}} °C</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PRESSURE')!="")
                                            <p class="m-0">Pressure: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PRESSURE')}} hPa</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('LUX')!="")
                                            <p class="m-0">Light: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('LUX')}} Lux</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM1')!="")
                                            <p class="m-0">PM1: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM1')}} μg/m3</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM2.5')!="")
                                            <p class="m-0">PM2.5: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM2.5')}} μg/m3</b></p>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM10')!="")
                                            <p class="m-0">PM10: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM10')}} μg/m3</b></p>
                                        @endif
                                @endif
                            @endif
                        <p class="mt-2">{{$place->details}}</p>
                        <a href="{{route('location.show', $place->id)}}" class="btn btn-primary float-right">Show more</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last update
                            @if($place->lastUpdatedDeviceInside()!=null) In:
                                <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM10')!="" ? $place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastUpdate('PM10') : $place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastUpdate('PM2.5')}}</b>
                            @endif
                            @if($place->lastUpdatedDeviceOutside()!=null) Out:
                                <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM10')!="" ? $place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastUpdate('PM10') : $place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastUpdate('PM2.5')}}</b>
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
