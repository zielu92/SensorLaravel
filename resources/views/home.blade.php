@extends('layouts.app')

@section('content')
    <div class="col-lg-12 bottom-air">
        <div class="pull-left">
            <h1>Devices</h1>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Device </th>
                <th>PM 2.5</th>
                <th>PM 10</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            @if($devices)
                @foreach($devices as $device)
                    <tr>
                        <td>{{$device->id}}</td>
                        <td><a href="{{route('admin.devices.show', $device->id)}}">{{$device->name}}</a> {{$device->location}}</td>
                        <td>{{$device->lastRecord('PM2.5')}}</td>
                        <td>{{$device->lastRecord('PM10')}}</td>
                        <td>{{$device->lastUpdate('PM10')!=null ? $device->lastUpdate('PM10')->diffForHumans() : null}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection

