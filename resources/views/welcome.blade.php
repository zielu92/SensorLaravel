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
                                    <b>Inside Sensor:</b>
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
    <div class="row">
        <div class="col-md-12">
            <h1>Overview Status</h1>
            <h4 class="pt-4 text-center">Map for Outside Sensor by Marker</h4>
            <div class="clearfix"></div>
            <hr class="pb-2">
            <div id="map-leaflet1"></div>
        </div>
    </div>         
    <div class="row pt-4">
        <div class="col-md-12">
            <h4 class="pt-4 text-center">Map for Inside Sensor by Marker</h4>
            <div class="clearfix"></div>
            <hr class="pb-2">
            <div id="map-leaflet2"></div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/leaflet.extra-markers.min.js') }}" defer></script>
<script src='https://api.mapbox.com/mapbox.js/v3.3.0/mapbox.js'></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
        L.mapbox.accessToken = '{{ env("MAPBOX_KEY") }}';

        var mapboxTiles1 = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=' + L.mapbox.accessToken, {
            attribution: '© <a href="https://www.mapbox.com/feedback/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 18,
            tileSize: 512,
            zoomOffset: -1
        });

        var mapboxTiles2 = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=' + L.mapbox.accessToken, {
            attribution: '© <a href="https://www.mapbox.com/feedback/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            tileSize: 512,
            zoomOffset: -1
        });

        var mapLeaflet1 = L.mapbox.map('map-leaflet1')
            .setView([13.652094, 100.494061], 18)
            .addLayer(mapboxTiles1);

        var mapLeaflet2 = L.mapbox.map('map-leaflet2')
            .setView([13.652094, 100.494061], 20)
            .addLayer(mapboxTiles2);

        var SITValue = L.ExtraMarkers.icon({
            shape: 'square',
            markerColor: 'green',
            icon: 'fa-number',
            number: '47'
        });

        var CB2Value = L.ExtraMarkers.icon({
            shape: 'square',
            markerColor: 'yellow',
            icon: 'fa-number',
            number: '58'
        });

        L.marker([13.652581, 100.493643], {
            icon: SITValue
        }).addTo(mapLeaflet1);

        L.marker([13.651502, 100.493715], {
            icon: CB2Value
        }).addTo(mapLeaflet1);
    });
</script>
@endsection