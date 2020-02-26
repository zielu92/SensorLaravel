@extends('layouts.app')

@section('content')
    <div class="col-lg-12 bottom-air">
        <div class="pull-left">
            <h1>Devices</h1>
        </div>
        <div class="pull-right">
            <a href="{{route('admin.devices.create')}}" class="btn btn-info btn-lg btn-info">Add new device</a>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Location</th>
                <th>MAC</th>
                <th>Created</th>
                <th>Edited</th>
            </tr>
            </thead>
            <tbody>
            @if($devices)
                @foreach($devices as $device)
                    <tr>
                        <td>{{$device->id}}</td>
                        <td><a href="{{route('admin.devices.edit', $device->id)}}">{{$device->name}}</a></td>
                        <td>{{$device->location}}</td>
                        <td>{{$device->mac}}</td>
                        <td>{{$device->created_at->diffForHumans()}}</td>
                        <td>{{$device->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
