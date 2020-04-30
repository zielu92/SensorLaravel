@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$location->name}} Status</h1>
        </div>
    </div>

    <div class="row col-md-12">
            @foreach($devices as $device)
            <div class="col-xs-12 col-md-12">
                <h5>Device: {{$device->name}}</h5>
                <p> Temperature: <b>{{$device->lastRecord('Temperature')}} °C</b>
                    Pressure: <b>{{$device->lastRecord('Pressure')}} hPa</b>
                    PM2.5: <b>{{$device->lastRecord('PM2.5')}} μg/m3</b>
                    PM10: <b>{{$device->lastRecord('PM10')}} μg/m3</b>
                    Last Update: <b>{{\Carbon\Carbon::parse($device->lastUpdate('PM10'))->format('d/m/Y')}}</b>

                </p>
            </div>
            <div class="col-md-12">
                <div class="btn btn-success pull-right" id="increaseView{{$device->id}}" style="border-radius: 60px"><i class="fas fa-plus-circle"></i> Zoom in</div>
                <div class="btn btn-danger pull-right" id="decreaseView{{$device->id}}" style="border-radius: 60px"><i class="fas fa-minus-circle"></i> Zoom out</div>
            </div>
            <div class="chart_wrapper">
                <div id="PM10_{{$device->id}}" ></div>
            </div>

            <div class="col-md-12">
                <div class="btn btn-success pull-right" id="increaseView{{$device->id}}" style="border-radius: 60px"><i class="fas fa-plus-circle"></i> Zoom in</div>
                <div class="btn btn-danger pull-right" id="decreaseView{{$device->id}}" style="border-radius: 60px"><i class="fas fa-minus-circle"></i> Zoom out</div>
            </div>
            <div class="chart_wrapper">
                <div id="PM2.5_{{$device->id}}" style="width: 100%"></div>
            </div>

            <div class="col-md-12">
                <div class="btn btn-success pull-right" id="increaseView{{$device->id}}" style="border-radius: 60px"><i class="fas fa-plus-circle"></i> Zoom in</div>
                <div class="btn btn-danger pull-right" id="decreaseView{{$device->id}}" style="border-radius: 60px"><i class="fas fa-minus-circle"></i> Zoom out</div>
            </div>
            <div class="chart_wrapper">
                <div id="temperature_{{$device->id}}" style="width: 100%"></div>
            </div>

            <div class="col-md-12">
                <div class="btn btn-success pull-right" id="increaseView{{$device->id}}" style="border-radius: 60px"><i class="fas fa-plus-circle"></i> Zoom in</div>
                <div class="btn btn-danger pull-right" id="decreaseView{{$device->id}}" style="border-radius: 60px"><i class="fas fa-minus-circle"></i> Zoom out</div>
            </div>
            <div class="chart_wrapper">
                <div id="pressure_{{$device->id}}" style="width: 100%"></div>
            </div>


            @endforeach
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
        google.charts.load('current', {'packages':['line']});
        @foreach($devices as $device)
            google.charts.setOnLoadCallback(drawChartPM10{{$device->id}});
            google.charts.setOnLoadCallback(drawChartPM25{{$device->id}});
            google.charts.setOnLoadCallback(drawChartTemp{{$device->id}});
            google.charts.setOnLoadCallback(drawChartPressure{{$device->id}});
            // Chart PM10
            function drawChartPM10{{$device->id}}() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date time');
                data.addColumn('number', 'PM10 μg/m3');

                data.addRows([
                    @foreach($device->sensor->where('valueName', '=', 'PM10') as $record)
                        [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                    @endforeach
                ]);
                var view = 800;
                var options = {
                    chart: {
                        title: 'PM10 Graph at {{$location->name}}',
                        subtitle: 'μg/m3'
                    },
                    height: 800,
                    width: view,
                    axes: {
                        x: {
                            0: {side: 'top'}
                        }
                    }
                };


                $('#increaseView{{$device->id}}').click(function() {
                    view = view+200;
                    chart.draw(data, {width: view}, {tooltip: {isHtml: true }});
                });

                $('#decreaseView{{$device->id}}').click(function() {
                    view = view-200;
                    chart.draw(data, {width: view}, {tooltip: {isHtml: true }});
                });

                var chart = new google.charts.Line(document.getElementById('PM10_{{$device->id}}'));

                chart.draw(data, {width: view}, google.charts.Line.convertOptions(options));
            }
        // Chart2.5
        function drawChartPM25{{$device->id}}() {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date time');
            data.addColumn('number', 'P2.5 μg/m3');
            data.addRows([
                    @foreach($device->sensor->where('valueName', '=', 'PM2.5') as $record)
                [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                @endforeach
            ]);
            var view = 800;
            var options = {
                chart: {
                    title: 'PM2.5 Graph at {{$location->name}}',
                    subtitle: 'μg/m3'
                },
                height: 500,
                width: view,
                axes: {
                    x: {
                        0: {side: 'top'}
                    }
                }
            };


            $('#increaseView{{$device->id}}').click(function() {
                view = view+200;
                chart.draw(data, {width: view}, {tooltip: {isHtml: true }});
            });

            $('#decreaseView{{$device->id}}').click(function() {
                view = view-200;
                chart.draw(data, {width: view}, {tooltip: {isHtml: true }});
            });

            var chart = new google.charts.Line(document.getElementById('PM2.5_{{$device->id}}'));

            chart.draw(data, {width: view}, google.charts.Line.convertOptions(options));
        }
        // chart temp
        function drawChartTemp{{$device->id}}() {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date time');
            data.addColumn('number', 'Temperature °C');

            data.addRows([
                    @foreach($device->sensor->where('valueName', '=', 'Temperature') as $record)
                [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                @endforeach
            ]);
            var view = 800;
            var options = {
                chart: {
                    title: 'Temperature Graph at {{$location->name}}',
                    subtitle: '°C'
                },
                height: 500,
                width: view,
                axes: {
                    x: {
                        0: {side: 'top'}
                    }
                }
            };


            $('#increaseView{{$device->id}}').click(function() {
                view = view+200;
                chart.draw(data, {width: view}, {tooltip: {isHtml: true }});
            });

            $('#decreaseView{{$device->id}}').click(function() {
                view = view-200;
                chart.draw(data, {width: view}, {tooltip: {isHtml: true }});
            });

            var chart = new google.charts.Line(document.getElementById('temperature_{{$device->id}}'));

            chart.draw(data, {width: view}, google.charts.Line.convertOptions(options));
        }

        function drawChartPressure{{$device->id}}() {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date time');
            data.addColumn('number', 'Pressure hPa');

            data.addRows([
                    @foreach($device->sensor->where('valueName', '=', 'Pressure') as $record)
                [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                @endforeach
            ]);
            var view = 800;
            var options = {
                chart: {
                    title: 'Pressure Graph at {{$location->name}}',
                    subtitle: 'hPa'
                },
                height: 500,
                width: view,
                axes: {
                    x: {
                        0: {side: 'top'}
                    }
                }
            };


            $('#increaseView{{$device->id}}').click(function() {
                view = view+200;
                chart.draw(data, {width: view}, {tooltip: {isHtml: true }});
            });

            $('#decreaseView{{$device->id}}').click(function() {
                view = view-200;
                chart.draw(data, {width: view}, {tooltip: {isHtml: true }});
            });

            var chart = new google.charts.Line(document.getElementById('pressure_{{$device->id}}'));

            chart.draw(data, {width: view}, google.charts.Line.convertOptions(options));
        }
        @endforeach
    </script>

@endsection
