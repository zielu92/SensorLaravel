@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{$place->name}} Status</h1>
    </div>
</div>
<div class="row m-3">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="card-title">SIT Building</h3>
                <div id="chart_div"></div>
                <p class="card-text mt-3">Today, pm2.5 value in this area is median, you can belong your mask</p>
                <a href="#" class="btn btn-primary">More information</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="card-title">CB2 Building</h3>
                <div id="chart_div2"></div>
                <p class="card-text mt-3">Today, pm2.5 value in this area is low, enjoy your life</p>
                <a href="#" class="btn btn-primary">More information</a>
            </div>
        </div>
    </div>
</div>
@endsection
