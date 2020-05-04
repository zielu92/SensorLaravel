@extends('layouts.app')

@section('content')
<!-- continue from div of class content -->
<div class="row">
    <div class="col-md-12">
        <h1>Overview Status</h1>
    </div>
</div>
<div class="row m-3">
    <div id='map-leaflet' class='map' class="col-md-12"></div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/leaflet.extra-markers.min.js') }}" defer></script>
    <script src='https://api.mapbox.com/mapbox.js/v3.3.0/mapbox.js'></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            L.mapbox.accessToken = '{{ env("MAPBOX_KEY") }}';
        var mapLeaflet = L.mapbox.map('map-leaflet')
            .setView([13.652094, 100.494061], 18)
            .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

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

        L.marker([13.652581, 100.493643], { icon: SITValue }).addTo(mapLeaflet);
        L.marker([13.651502, 100.493715], { icon: CB2Value }).addTo(mapLeaflet);
        });
    </script>
@endsection
