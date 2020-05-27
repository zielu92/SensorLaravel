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
                                @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->count()>0)
                                    <b>Inside:</b>
                                    <p> @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('TEMPERATURE')!="")
                                            Temperature: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('TEMPERATURE')}} °C</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PRESSURE')!="")
                                            Pressure: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PRESSURE')}} hPa</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('LUX')!="")
                                            Light: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('LUX')}} Lux</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM1')!="")
                                            PM1: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM1')}} μg/m3</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM2.5')!="")
                                            PM2.5: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM2.5')}} μg/m3</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM10')!="")
                                            PM10: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceInside())->first()->lastRecord('PM10')}} μg/m3</b><br>
                                        @endif
                                    </p>
                                @endif
                            @endif
                            @if($place->lastUpdatedDeviceOutside()!=null)
                                @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->count()>0)
                                    <b>outside:</b>
                                    <p> @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('TEMPERATURE')!="")
                                            Temperature: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('TEMPERATURE')}} °C</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PRESSURE')!="")
                                            Pressure: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PRESSURE')}} hPa</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('LUX')!="")
                                            Light: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('LUX')}} Lux</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM1')!="")
                                            PM1: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM1')}} μg/m3</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM2.5')!="")
                                            PM2.5: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM2.5')}} μg/m3</b><br>
                                        @endif
                                        @if($place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM10')!="")
                                            PM10: <b>{{$place->device->where('id','=',$place->lastUpdatedDeviceOutside())->first()->lastRecord('PM10')}} μg/m3</b><br>
                                        @endif
                                    </p>
                                @endif
                            @endif
                            </h5>
                        <p>{{$place->details}}</p>
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
