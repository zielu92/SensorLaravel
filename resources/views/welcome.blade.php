@extends('layouts.app')

@section('content')
<header class="text-center vertical-center kmutt-bangmod-campus">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bannerText font-weight-bold">
                <p>KMUTT Air Pollution:</p>
                <p>Real-time Air Quality Index (AQI)</p>
            </div>
        </div>
    </div>
</header>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!--Information stuff-->
            <div class="col-md-6">
                <div class="contentInfo">
                    <div class="row">
                        <div class="col-md-4">
                            <select id="mySelect" data-show-content="true" class="form-control border">
                                <!-- data of Place table from databasde -->
                                <option>Place</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                        <div class="row">
                            <div class="p-3">
                                <nav class="nav nav-pills flex-column flex-sm-row">
                                    <!-- data of Location on that place -->
                                    <!-- The nav width depend on data that contain -->
                                    <!-- When click show the information of that location -->
                                    <a class="flex-sm-fill text-sm-center nav-link active" href="#">Location</a>
                                </nav>
                            </div>
                        </div>
                    @if($devices)
                        @foreach($devices as $device)
                        <div class="locationInfo pt-3">
                            <div class="row ml-3">
                                <div class="col-md-12">
                                    <h1><a href="{{route('admin.devices.show', $device->id)}}">{{$device->name}}</a> {{$device->location}}</h1>
                                </div>
                                <div class="col-md-12">
                                    <blockquote class="blockquote">
                                        <footer class="blockquote-footer">Updated on: {{$device->lastUpdate('PM10')!=null ? $device->lastUpdate('PM10')->diffForHumans() : null}}
                                            <!--current date from database -->
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ml-4 mr-4 mb-4 status">
                                    <h1 class="pmStatus">PM2.5: {{$device->lastRecord('PM2.5')}}</h1>
                                </div>
                            </div>
                            <div class="row">
                                <!-- data of graph for each locations-->
                                <div class="col-md-12">
                                    <div id="chart_div" class="chart"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            <!--KMUTT map and the PM2.5 value for each areas-->
            <div class="col-md-6">

            </div>
        </div>
    </div>
</section>
