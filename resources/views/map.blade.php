@extends('layouts.app')

@section('content')
    <!-- continue from div of class content -->
    <div class="row">
        <div class="col-md-12">
            <h1>Overview {{$title}} Status</h1>
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
            tileSize: 512,
            zoomOffset: -1
        });
        var mapboxTiles2 = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=' + L.mapbox.accessToken, {
            attribution: '© <a href="https://www.mapbox.com/feedback/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            tileSize: 512,
            zoomOffset: -1
        });
        //internal
        var mapLeaflet1 = L.mapbox.map('map-leaflet1')
            .setView([13.652094, 100.494061], 17)
            .addLayer(mapboxTiles1);
        //external
        var mapLeaflet2 = L.mapbox.map('map-leaflet2')
            .setView([13.652094, 100.494061], 16)
            .addLayer(mapboxTiles2);

        //external
        @if($externalPlaces!=null)
            @foreach($externalPlaces as $place)
                var placeOut{{$place['id']}} = L.ExtraMarkers.icon({
                        shape: 'square',
                        markerColor: '{{$place["color"]}}',
                        icon: 'fa-number',
                        number: '{{$place["value"]}}'
                    });

                    L.marker([{{$place['lat']}}, {{$place['lon']}}], {
                        icon: placeOut{{$place['id']}}
                    }).addTo(mapLeaflet2);

            @endforeach
        @endif

        //internal
        @if($internalPlaces!=null)
        @foreach($internalPlaces as $place)
            var placeOut{{$place['id']}} = L.ExtraMarkers.icon({
                    shape: 'square',
                    markerColor: '{{$place["color"]}}',
                    icon: 'fa-number',
                    number: '{{$place["value"]}}'
                });

            L.marker([{{$place['lat']}}, {{$place['lon']}}], {
                icon: placeOut{{$place['id']}}
            }).addTo(mapLeaflet2);
        @endforeach
        @endif
    });
</script>
@endsection
