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
                                <h5>{{$location->name}} {{$location->floor!=null ? " Floor ".$location->floor : ""}}</h5>
                                <div id="chartLocation{{$location->id}}" style="width: 100%; height: 120px;"></div>
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
        google.charts.setOnLoadCallback(drawChart{{$location->id}});

        function drawChart{{$location->id}}() {
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                @if($location->device[0]->lastRecord('PM2.5') != null)
                    ['PM2.5', {{$location->device[0]->lastRecord('PM2.5')}}],
                @endif
                @if($location->device[0]->lastRecord('PM10') != null)
                    ['PM10', {{$location->device[0]->lastRecord('PM10')}}],
                @endif
            ]);

            var options = {
                //TODO: GREEN ORANGE RED FORM
                redFrom: 90, redTo: 100,
                yellowFrom:75, yellowTo: 90,
                minorTicks: 5
            };
            var chart = new google.visualization.Gauge(document.getElementById('chartLocation{{$location->id}}'));
            chart.draw(data, options);

        }
        @endforeach
    </script>
@endsection
