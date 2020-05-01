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
                                    <div class="gauge" id="chartLocationPM25{{$location->id}}" style="height: 120px;"></div>
                                    <div class="gauge" id="chartLocationPM10{{$location->id}}" style="height: 120px;"></div>
                                </div>
                                <p> Temperature: <b>{{$location->device[0]->lastRecord('TEMPERATURE')}} °C</b><br>
                                    Pressure: <b>{{$location->device[0]->lastRecord('PRESSURE')}} hPa</b><br>
                                    PM2.5: <b>{{$location->device[0]->lastRecord('PM2.5')}} μg/m3</b><br>
                                    PM10: <b>{{$location->device[0]->lastRecord('PM10')}} μg/m3</b><br>
                                    Last Update: <b>{{$location->device[0]->lastUpdate('PM10')}}</b>
                                </p>
                            </div>
                        </div>
                    </div>
            </a>
        </div>
    @endforeach
    </div>
</div>

{{--<div class="col-md4">--}}
{{--    <div id="chart_div3" style="width: 400px; height: 120px;"></div>--}}
{{--</div>--}}
{{--<div class="row m-3">--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="card text-center">--}}
{{--            <div class="card-body">--}}
{{--                <h3 class="card-title">SIT Building</h3>--}}
{{--                <div id="chart_div"></div>--}}
{{--                <p class="card-text mt-3">Today, pm2.5 value in this area is median, you can belong your mask</p>--}}
{{--                <a href="#" class="btn btn-primary">More information</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="card text-center">--}}
{{--            <div class="card-body">--}}
{{--                <h3 class="card-title">CB2 Building</h3>--}}
{{--                <div id="chart_div2"></div>--}}
{{--                <p class="card-text mt-3">Today, pm2.5 value in this area is low, enjoy your life</p>--}}
{{--                <a href="#" class="btn btn-primary">More information</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {'packages':['gauge']});
        @foreach($locations as $location)
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
        @endforeach
    </script>
@endsection
