@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{$place->name}} Status</h1>
    </div>
</div>

<div class="row">
    <div class="card-deck col-md-12">
    @foreach($locations as $location)
        @if($location->device->where('id', '=', $location->lastUpdatedDevice())->count()>0)
            <div class="col-md-4 pb-4">
                    <a href="{{route('device.index', $location->id)}}" class="text-dark">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">{{$location->name}} {{$location->isInside==1  ? " inside" : " outside" }} {{$location->floor!=null ? " Floor ".$location->floor : ""}}</h5>
                                <h4>Last Update</h4>
                                <div class="text-center">
                                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM1')!="")
                                        <div class="gauge" id="chartLocationPM1{{$location->id}}" style="height: 120px;"></div>
                                    @endif
                                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM2.5')!="")
                                        <div class="gauge" id="chartLocationPM25{{$location->id}}" style="height: 120px;"></div>
                                    @endif
                                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM10')!="")
                                        <div class="gauge" id="chartLocationPM10{{$location->id}}" style="height: 120px;"></div>
                                    @endif
                                </div>
                                <p> @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('TEMPERATURE')!="")
                                        Temperature: <b>{{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('TEMPERATURE')}} °C</b><br>
                                    @endif
                                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PRESSURE')!="")
                                        Pressure: <b>{{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PRESSURE')}} hPa</b><br>
                                    @endif
                                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('LUX')!="")
                                        Light: <b>{{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('LUX')}} Lux</b><br>
                                    @endif
                                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM1')!="")
                                        PM1: <b>{{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM1')}} μg/m3</b><br>
                                    @endif
                                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM2.5')!="")
                                        PM2.5: <b>{{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM2.5')}} μg/m3</b><br>
                                    @endif
                                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM10')!="")
                                        PM10: <b>{{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM10')}} μg/m3</b><br>
                                    @endif
                                    Last Update: <b>{{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM10')!="" ? $location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastUpdate('PM10') : $location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastUpdate('PM2.5')}}</b>
                                </p>
                                <h4>Last 24h:</h4>
                                @if($location->checkValue24('TEMPERATURE'))
                                    <p>
                                        <b>Temperature:</b>
                                        <br>
                                        min: <b>{{$location->minValue24('TEMPERATURE')}} °C</b> avg: <b>{{$location->avgValue24('TEMPERATURE')}} °C</b> max: <b>{{$location->maxValue24('TEMPERATURE')}} °C</b><br>
                                    </p>
                                @endif
                                @if($location->checkValue24('PRESSURE'))
                                    <p>
                                        <b>Pressure:</b>
                                        <br>
                                        min: <b>{{$location->minValue24('PRESSURE')}} hPa</b> avg: <b>{{$location->avgValue24('PRESSURE')}} hPa</b> max: <b>{{$location->maxValue24('PRESSURE')}} hPa</b><br>
                                    </p>
                                @endif
                                @if($location->checkValue24('LUX'))
                                    <p>
                                        <b>Light:</b>
                                        <br>
                                        min: <b>{{$location->minValue24('LUX')}} Lux</b> avg: <b>{{$location->avgValue24('LUX')}} Lux</b> max: <b>{{$location->maxValue24('LUX')}} Lux</b><br>
                                    </p>
                                @endif
                                @if($location->checkValue24('PM1'))
                                    <p>
                                        <b>PM1:</b>
                                        <br>
                                        min: <b>{{$location->minValue24('PM1')}} μg/m3</b> avg: <b>{{$location->avgValue24('PM1')}} μg/m3</b> max: <b>{{$location->maxValue24('PM1')}} μg/m3</b><br>
                                    </p>
                                @endif
                                @if($location->checkValue24('PM2.5'))
                                    <p>
                                        <b>PM2.5:</b>
                                        <br>
                                        min: <b>{{$location->minValue24('PM2.5')}} μg/m3</b> avg: <b>{{$location->avgValue24('PM2.5')}} μg/m3</b> max: <b>{{$location->maxValue24('PM2.5')}} μg/m3</b><br>
                                    </p>
                                @endif
                                @if($location->checkValue24('PM10'))
                                    <p>
                                        <b>PM10:</b>
                                        <br>
                                        min: <b>{{$location->minValue24('PM10')}} μg/m3</b> avg: <b>{{$location->avgValue24('PM10')}} μg/m3</b> max: <b>{{$location->maxValue24('PM10')}} μg/m3</b><br>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
            </div>
        @endif
    @endforeach
    </div>
</div>

@endsection
@section('scripts')
    <script type="text/javascript">
        google.charts.load('current', {'packages':['gauge']});
        @foreach($locations as $location)
            @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM1')!="")
                google.charts.setOnLoadCallback(drawChartPM1{{$location->id}});

                function drawChartPM1{{$location->id}}() {
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                            @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM1') != null)
                        ['PM1', {{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM1')}}],
                        @endif
                    ]);

                    var options = {

                        minorTicks: 5,
                        max: 250
                    };
                    var chart = new google.visualization.Gauge(document.getElementById('chartLocationPM1{{$location->id}}'));
                    chart.draw(data, options);

                }
            @endif
            @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM2.5')!="")
                google.charts.setOnLoadCallback(drawChartPM25{{$location->id}});

                function drawChartPM25{{$location->id}}() {
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM2.5') != null)
                            ['PM2.5', {{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM2.5')}}],
                        @endif
                    ]);

                    var options = {
                        //https://www.airveda.com/blog/Understanding-Particulate-Matter-and-Its-Associated-Health-Impact - ranges from here
                        greenFrom: 0, greenTo: 60,
                        yellowFrom:61, yellowTo: 120,
                        redFrom: 121, redTo: 250,
                        minorTicks: 5,
                        max: 250
                    };
                    var chart = new google.visualization.Gauge(document.getElementById('chartLocationPM25{{$location->id}}'));
                    chart.draw(data, options);

                }
            @endif
            @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM10')!="")
            google.charts.setOnLoadCallback(drawChartPM10{{$location->id}});

            function drawChartPM10{{$location->id}}() {
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    @if($location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM10') != null)
                        ['PM10', {{$location->device->where('id', '=', $location->lastUpdatedDevice())[0]->lastRecord('PM10')}}],
                    @endif
                ]);

                var options = {
                    //https://www.airveda.com/blog/Understanding-Particulate-Matter-and-Its-Associated-Health-Impact - ranges from here
                    greenFrom: 0, greenTo: 100,
                    yellowFrom:101, yellowTo: 350,
                    redFrom: 351, redTo: 430,
                    minorTicks: 5,
                    max: 430
                };
                var chart = new google.visualization.Gauge(document.getElementById('chartLocationPM10{{$location->id}}'));
                chart.draw(data, options);
            }
            @endif
        @endforeach
    </script>
@endsection
