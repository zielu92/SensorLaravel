@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$location->name}} {{$location->isInside==1 ? " inside" : " outside" }} {{$location->floor!=null ? " Floor ".$location->floor : ""}} Status</h1>
        </div>
    </div>

    <div class="row m-3">
            @foreach($devices as $device)
                @if($device->sensor->where('device_id', '=', $device->id)->count() > 0)
                    <div class="col-xs-12 col-md-12">
                        <h5>Device: {{$device->name}}</h5>
                        <p>
                            @if($device->lastRecord('TEMPERATURE')!="")
                                Temperature: <b>{{$device->lastRecord('TEMPERATURE')}} °C</b>
                            @endif
                            @if($device->lastRecord('PRESSURE')!="")
                                Pressure: <b>{{$device->lastRecord('PRESSURE')}} hPa</b>
                            @endif
                            @if($device->lastRecord('PM1')!="")
                                PM1: <b>{{$device->lastRecord('PM1')}} μg/m3</b>
                            @endif
                            @if($device->lastRecord('PM2.5')!="")
                                PM2.5: <b>{{$device->lastRecord('PM2.5')}} μg/m3</b>
                            @endif
                            @if($device->lastRecord('PM10')!="")
                                PM10: <b>{{$device->lastRecord('PM10')}} μg/m3</b>
                            @endif
                            @if($device->lastRecord('LUX')!="")
                                Light: <b>{{$device->lastRecord('LUX')}} lux</b>
                            @endif
                            @if($device->lastRecord('PM10')!="")
                                Last Update: <b>{{\Carbon\Carbon::parse($device->lastUpdate('PM10'))->format('d/m/Y')}}</b>
                            @else
                                Last Update: <b>unknown</b>
                            @endif
                        </p>
                    </div>
                    @if($device->lastRecord('PM1')!="")
                        <div class="col-md-6 pb-4">
                            <div id="PM1_{{$device->id}}" class="chart"></div>
                        </div>
                    @endif
                    @if($device->lastRecord('PM2.5')!="")
                        <div class="col-md-6 pb-4">
                            <div id="PM2.5_{{$device->id}}" class="chart"></div>
                        </div>
                    @endif
                    @if($device->lastRecord('PM10')!="")
                        <div class="col-md-6 pb-4">
                            <div id="PM10_{{$device->id}}" class="chart"></div>
                        </div>
                    @endif
                    @if($device->lastRecord('TEMPERATURE')!="")
                    <div class="col-md-6 pb-4">
                        <div id="temperature_{{$device->id}}" class="chart"></div>
                    </div>
                    @endif
                    @if($device->lastRecord('PRESSURE')!="")
                    <div class="col-md-6 pb-4">
                        <div id="pressure_{{$device->id}}" class="chart"></div>
                    </div>
                    @endif
                    @if($device->lastRecord('LUX')!="")
                    <div class="col-md-6 pb-4">
                        <div id="light_{{$device->id}}" class="chart"></div>
                    </div>
                    @endif
                @endif
            @endforeach
        </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        @foreach($devices as $device)
            @if($device->lastRecord('PM1')!="")
            google.charts.setOnLoadCallback(drawChartPM1{{$device->id}});
            @endif
            @if($device->lastRecord('PM10')!="")
            google.charts.setOnLoadCallback(drawChartPM10{{$device->id}});
            @endif
            @if($device->lastRecord('PM2.5')!="")
            google.charts.setOnLoadCallback(drawChartPM25{{$device->id}});
            @endif
            @if($device->lastRecord('TEMPERATURE')!="")
            google.charts.setOnLoadCallback(drawChartTemp{{$device->id}});
            @endif
            @if($device->lastRecord('PRESSURE')!="")
            google.charts.setOnLoadCallback(drawChartPressure{{$device->id}});
            @endif
            @if($device->lastRecord('LUX')!="")
            google.charts.setOnLoadCallback(drawChartLight{{$device->id}});
            @endif
            //chart pm1
            function drawChartPM1{{$device->id}}() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date time');
                data.addColumn('number', 'PM10 μg/m3');

                data.addRows([
                    @foreach($device->sensor->where('valueName', 'ilike', 'PM1') as $record)
                        [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                    @endforeach
                ]);
                var options = {
                    title: 'PM1 Graph at {{$location->name}}',
                    chartArea: {
                        width: '80%',
                        height: '70%'
                    },
                    legend: {
                        position: 'bottom',
                    },
                    hAxis: {
                        title: 'Date & Time'
                    },
                    vAxis: {
                        title: 'μg/m3 Values',
                        minValue: 0
                    },
                    explorer: {
                        axis: 'horizontal',
                        keepInBounds: true,
                        maxZoomIn: 6.0,
                        maxZoomOut: 1.0
                    },
                };
                var chart = new google.visualization.LineChart(document.getElementById('PM1_{{$device->id}}'));
                chart.draw(data, options);
            }
            // Chart2.5
            function drawChartPM25{{$device->id}}() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date time');
                data.addColumn('number', 'P2.5 μg/m3');
                data.addRows([
                    @foreach($device->sensor->where('valueName', 'ilike', 'PM2.5') as $record)
                        @if($record!=null)
                            [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                        @endif
                    @endforeach
                ]);
                var options = {
                    title: 'PM2.5 Graph at {{$location->name}}',
                    chartArea: {
                        width: '80%',
                        height: '70%'
                    },
                    legend: {
                        position: 'bottom',
                    },
                    hAxis: {
                        title: 'Date & Time'
                    },
                    vAxis: {
                        title: 'μg/m3 Values',
                        minValue: 0
                    },
                    explorer: {
                        axis: 'horizontal',
                        keepInBounds: true,
                        maxZoomIn: 6.0,
                        maxZoomOut: 1.0
                    },
                };
                var chart = new google.visualization.LineChart(document.getElementById('PM2.5_{{$device->id}}'));
                chart.draw(data, options);
            }
            // Chart PM10
            function drawChartPM10{{$device->id}}() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date time');
                data.addColumn('number', 'PM10 μg/m3');

                data.addRows([
                    @foreach($device->sensor->where('valueName', 'ilike', 'PM10') as $record)
                        [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                    @endforeach
                ]);
                var options = {
                    title: 'PM10 Graph at {{$location->name}}',
                    chartArea: {
                        width: '80%',
                        height: '70%'
                    },
                    legend: {
                        position: 'bottom',
                    },
                    hAxis: {
                        title: 'Date & Time'
                    },
                    vAxis: {
                        title: 'μg/m3 Values',
                        minValue: 0
                    },
                    explorer: {
                        axis: 'horizontal',
                        keepInBounds: true,
                        maxZoomIn: 6.0,
                        maxZoomOut: 1.0
                    },
                };
                var chart = new google.visualization.LineChart(document.getElementById('PM10_{{$device->id}}'));
                chart.draw(data, options);
            }
            // chart temp
            function drawChartTemp{{$device->id}}() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date time');
                data.addColumn('number', 'Temperature °C');

                data.addRows([
                    @foreach($device->sensor->where('valueName', 'ilike', 'TEMPERATURE') as $record)
                        [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                    @endforeach
                ]);
                var options = {
                    title: 'Temperature Graph at {{$location->name}}',
                    chartArea: {
                        width: '80%',
                        height: '70%'
                    },
                    legend: {
                        position: 'bottom',
                    },
                    hAxis: {
                        title: 'Date & Time'
                    },
                    vAxis: {
                        title: '°C Values',
                        minValue: 0
                    },
                    explorer: {
                        axis: 'horizontal',
                        keepInBounds: true,
                        maxZoomIn: 6.0,
                        maxZoomOut: 1.0
                    },
                };
                var chart = new google.visualization.LineChart(document.getElementById('temperature_{{$device->id}}'));
                chart.draw(data,options);
            }

            function drawChartPressure{{$device->id}}() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date time');
                data.addColumn('number', 'Pressure hPa');

                data.addRows([
                    @foreach($device->sensor->where('valueName', 'ilike', 'PRESSURE') as $record)
                        [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                    @endforeach
                ]);
                var options = {
                    title: 'Pressure Graph at {{$location->name}}',
                    chartArea: {
                        width: '80%',
                        height: '70%'
                    },
                    legend: {
                        position: 'bottom',
                    },
                    hAxis: {
                        title: 'Date & Time'
                    },
                    vAxis: {
                        title: 'hPa Values',
                        minValue: 0
                    },
                    explorer: {
                        axis: 'horizontal',
                        keepInBounds: true,
                        maxZoomIn: 6.0,
                        maxZoomOut: 1.0
                    },
                };
                var chart = new google.visualization.LineChart(document.getElementById('pressure_{{$device->id}}'));
                chart.draw(data,options);
            }

            function drawChartLight{{$device->id}}() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date time');
                data.addColumn('number', 'Light in Lux');

                data.addRows([
                    @foreach($device->sensor->where('valueName', 'ilike', 'LUX') as $record)
                        [new Date(Date.UTC({{\Carbon\Carbon::parse($record->created_at)->format('Y, m, d, H, i, s, u')}})),  {{$record->value}}],
                    @endforeach
                ]);
                var options = {
                    title: 'Light Graph at {{$location->name}}',
                    chartArea: {
                        width: '80%',
                        height: '70%'
                    },
                    legend: {
                        position: 'bottom',
                    },
                    hAxis: {
                        title: 'Date & Time'
                    },
                    vAxis: {
                        title: 'lux Values',
                        minValue: 0
                    },
                    explorer: {
                        axis: 'horizontal',
                        keepInBounds: true,
                        maxZoomIn: 6.0,
                        maxZoomOut: 1.0
                    },
                }
                var chart = new google.visualization.LineChart(document.getElementById('light_{{$device->id}}'));
                chart.draw(data,options);
            }
            $(window).resize(function(){
                drawChartPM25{{$device->id}}();
                drawChartPM10{{$device->id}}();
                drawChartTemp{{$device->id}}();
                drawChartPressure{{$device->id}}();
                drawChartLight{{$device->id}}();
            });
        @endforeach
    </script>

@endsection
