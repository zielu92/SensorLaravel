@extends('layouts.app')

@section('content')
<!-- continue from div of class content -->
<div class="row">
    <div class="col-md-12">
        <h1>Overview Status</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="outside-tab" data-toggle="tab" href="#outside" role="tab" aria-controls="outside" aria-selected="true">Outside</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inside-tab" data-toggle="tab" href="#inside" role="tab" aria-controls="inside" aria-selected="false">Inside</a>
            </li>
        </ul>
    </div>
</div>
<div class="row m-3">
    <div class="col-md-12">
        <div class="tab-content">
            <div class="tab-pane active" id="outside" role="tabpanel" aria-labelledby="outside-tab">
                <div id="map-leaflet1"></div>
            </div>
            <div class="tab-pane" id="inside" role="tabpanel" aria-labelledby="inside-tab">
                <div id="map-leaflet2"></div>
            </div>
        </div>
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