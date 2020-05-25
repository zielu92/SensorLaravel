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
            <div class="row pl-4">
                <h1>Monitor Environment</h1>
                <div class="row">
                    <div class="col-md-4">
                        <i class="fas fa-smog"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 pt-4">
            <img class="w-100" src="img/scheme.png">
        </div>
    </div>
</div>
@endsection