@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{$place->name}} Status</h1>
    </div>
</div>

<div class="row col-md-12">
    <div class="card-deck">
    @foreach($locations as $location)

        <div class="col-lg-4 col-md-5 col-sm-12">
            <a href="{{route('device.index', $location->id)}}" class="text-dark">
                <div class="card shadow">
                    <div class="card-body">
                            <div class="col-xs-8 col-sm-7 col-md-8">
                                <h5>{{$location->name}} {{$location->isInside==1  ? " inside" : " outside" }} {{$location->floor!=null ? " Floor ".$location->floor : ""}}</h5>
                                <div>
                                    @if($location->device[0]->lastRecord('PM1')!="")
                                        <div class="gauge" id="chartLocationPM1{{$location->id}}" style="height: 120px;"></div>
                                    @endif
                                    @if($location->device[0]->lastRecord('PM2.5')!="")
                                        <div class="gauge" id="chartLocationPM25{{$location->id}}" style="height: 120px;"></div>
                                    @endif
                                    @if($location->device[0]->lastRecord('PM10')!="")
                                        <div class="gauge" id="chartLocationPM10{{$location->id}}" style="height: 120px;"></div>
                                    @endif
                                </div>
                                <p> @if($location->device[0]->lastRecord('TEMPERATURE')!="")
                                        Temperature: <b>{{$location->device[0]->lastRecord('TEMPERATURE')}} °C</b><br>
                                    @endif
                                    @if($location->device[0]->lastRecord('PRESSURE')!="")
                                        Pressure: <b>{{$location->device[0]->lastRecord('PRESSURE')}} hPa</b><br>
                                    @endif
                                    @if($location->device[0]->lastRecord('LUX')!="")
                                        Light: <b>{{$location->device[0]->lastRecord('LUX')}} Lux</b><br>
                                    @endif
                                    @if($location->device[0]->lastRecord('PM1')!="")
                                        PM1: <b>{{$location->device[0]->lastRecord('PM1')}} μg/m3</b><br>
                                    @endif
                                    @if($location->device[0]->lastRecord('PM2.5')!="")
                                        PM2.5: <b>{{$location->device[0]->lastRecord('PM2.5')}} μg/m3</b><br>
                                    @endif
                                    @if($location->device[0]->lastRecord('PM10')!="")
                                        PM10: <b>{{$location->device[0]->lastRecord('PM10')}} μg/m3</b><br>
                                    @endif
                                    Last Update: <b>{{$location->device[0]->lastRecord('PM10')!="" ? $location->device[0]->lastUpdate('PM10') : $location->device[0]->lastUpdate('PM2.5')}}</b>
                                </p>
                            </div>
                        </div>
                    </div>
            </a>
        </div>
    @endforeach
    </div>
</div>

@endsection
@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {'packages':['gauge']});
        @foreach($locations as $location)
            @if($location->device[0]->lastRecord('PM1')!="")
                google.charts.setOnLoadCallback(drawChartPM1{{$location->id}});

                function drawChartPM1{{$location->id}}() {
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                            @if($location->device[0]->lastRecord('PM1') != null)
                        ['PM1', {{$location->device[0]->lastRecord('PM1')}}],
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
            @if($location->device[0]->lastRecord('PM2.5')!="")
                google.charts.setOnLoadCallback(drawChartPM25{{$location->id}});

                function drawChartPM25{{$location->id}}() {
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        @if($location->device[0]->lastRecord('PM2.5') != null)
                            ['PM2.5', {{$location->device[0]->lastRecord('PM2.5')}}],
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
            @if($location->device[0]->lastRecord('PM10')!="")
            google.charts.setOnLoadCallback(drawChartPM10{{$location->id}});

            function drawChartPM10{{$location->id}}() {
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    @if($location->device[0]->lastRecord('PM10') != null)
                        ['PM10', {{$location->device[0]->lastRecord('PM10')}}],
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
