@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
                @if($devices)
                    @foreach($devices as $device)
                    <div class="col">
                        <div class="weather-card one" style="background-color: #1d643b;">
                    <div class="top">
                        <div class="wrapper">
                            <div class="mynav">
                                <a href="javascript:;"><span class="lnr lnr-chevron-left"></span></a>
                                <a href="javascript:;"><span class="lnr lnr-cog"></span></a>
                            </div>
                            <h1 class="heading">AIR quality is good</h1>
                            <h3 class="location">{{$device->location}}</h3>
                            <p class="temp">
                                <span class="temp-value">{{$device->lastRecord('PM2.5')}}</span>
                                <a href="javascript:;"><span class="temp-type">u</span></a>
                            </p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="wrapper">
                            <ul class="forecast">
                                <a href="javascript:;"><span class="lnr lnr-chevron-up go-up"></span></a>
                                <li class="active">
                                    <span class="date">Min</span>
                                    <span class="lnr lnr-sad condition">
									<span class="temp">23<span class="temp-type">u</span></span>
								</span>
                                </li>
                                <li>
                                    <span class="date">Max</span>
                                    <span class="lnr lnr-smile condition">
									<span class="temp">45<span class="temp-type">u</span></span>
								</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                    </div>
                    @endforeach
                @endif
        </div>
    </div>
@endsection

