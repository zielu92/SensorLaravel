L.mapbox.accessToken = process.env.MAPBOX_KEY;
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