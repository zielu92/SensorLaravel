@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="pull-left">
            <h1>Device {{$device->name}} at {{$device->location}}</h1>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Sensor</th>
                <th>Value name</th>
                <th>Value</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @if($sensors)
                @foreach($sensors as $sensor)
                    <tr>
                        <td>{{$sensor->id}}</td>
                        <td>{{$sensor->name}}</td>
                        <td>{{$sensor->valueName}}</td>
                        <td>{{$sensor->value}}</td>
                        <td>{{$sensor->created_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
