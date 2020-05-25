@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>About us</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <p class="ml-4 mr-4 pt-4 pl-4 pr-4 pb-4">The concept begins with the PM2.5 dust problem in Thailand. The faculty mounted Sensor to quantify
                dust around the classroom, and I believe each class still has different dust values.
                To take prevention steps such as using a mask Installing an air purifier Let us worry about this idea.
                Measure the amount of dust in the different rooms of the faculty.</P>            
            </div>
            <hr class="mt-1">
            <div class="row">
                <div class="col-md-12">
                    <h1>Monitor Environment</h1>
                </div>
            </div>
            <div class="row pt-4 text-center">
                <div class="col-md-4">
                    <h4 class="font-weight-bold pb-2">PM1</h4>
                    <i class="fas fa-wind fa-5x"></i>
                    <p class="pt-3">PM1 are extremely fine particulates with a diameter of fewer than 1 microns</p>
                </div>
                <div class="col-md-4">
                    <h4 class="font-weight-bold pb-2">PM2.5</h4>
                    <i class="fas fa-wind fa-5x"></i>
                    <p class="pt-3">PM2.5 refers to atmospheric particulate matter (PM) that have a diameter of less than 2.5 micrometers, which is about 3% the diameter of a human hair.</p>
                </div>
                <div class="col-md-4">
                    <h4 class="font-weight-bold pb-2">PM10</h4>
                    <i class="fas fa-wind fa-5x"></i>
                    <p class="pt-3">PM10 are particles equal to or smaller than 10 microns (PM10).</p>
                </div>
            </div>
            <div class="row pt-2 text-center">
                <div class="col-md-4">
                    <h4 class="font-weight-bold pb-2">AQI</h4>
                    <i class="fas fa-smog fa-5x"></i>
                    <p class="pt-3">The air quality data collected from these monitors are translated into actionable information</p>
                </div>
                <div class="col-md-4">
                    <h4 class="font-weight-bold pb-2">Temperature</h4>
                    <i class="fas fa-thermometer-half fa-5x"></i>
                    <p class="pt-3">Measure the temperature each room</p>
                </div>
                <div class="col-md-4">
                    <h4 class="font-weight-bold pb-2">Pressure</h4>
                    <i class="fas fa-tachometer-alt fa-5x"></i>
                    <p class="pt-3">Measure the pressure each room</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 pt-4">
            <img class="w-100" src="img/scheme.png">
        </div>
    </div>
    <hr class="pb-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Team Member</h1>
        </div>
    </div>
</div>
@endsection