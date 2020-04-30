@extends('layouts.app')

@section('content')
<div class="col-lg-12">
    <h1>Places and locations</h1>
    <div class="col-md-12">
        <h4>Add new place</h4>
        {!! Form::open(['method'=>'POST', 'action'=>'AdminPlaceController@store', 'files'=>true, 'class'=>'form-row']) !!}
        <div class="form-group col-md-3">
            {!! Form::label('name', 'Place name') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('lat', 'Latitude') !!}
            {!! Form::text('lat', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('lon', 'Longitude') !!}
            {!! Form::text('lon', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-5">
            {!! Form::label('details', 'Details') !!}
            {!! Form::text('details', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('picture', 'Background picture') !!}
            {!! Form::file('picture', ['class'=>'form-control-file', 'id'=>'imgInp']) !!}
        </div>

        <div class="form-group col-md-6">
            {!! Form::label('icon', 'Icon') !!}
            {!! Form::file('icon', ['class'=>'form-control-file',  'id'=>'imgInp']) !!}
        </div>

        <div class="form-group col-md-6">
            {!! Form::submit('Add new place', ['class'=>'btn btn-primary ']) !!}
        </div>

        {!! Form::close() !!}

        <h4>Add new location</h4>
        {!! Form::open(['method'=>'POST', 'action'=>'LocationController@store', 'class'=>'form-row']) !!}

        <div class="form-group col-md-3">
            {!! Form::label('place_id', 'Place') !!}
            {!! Form::select('place_id', $places, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group col-md-3">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-1">
            {!! Form::label('floor', 'Floor') !!}
            {!! Form::text('floor', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group col-md-5">
            {!! Form::label('details', 'Details') !!}
            {!! Form::text('details', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group col-md-12">
            {!! Form::submit('Add new location', ['class'=>'btn btn-primary ']) !!}
        </div>

        {!! Form::close() !!}
    </div>
    <div class="col-md-12">
        <h4>Locations preview</h4>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$locations->render()}}
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Place name</th>
                        <th>Location name</th>
                        <th>Details</th>
                        <th>Floor</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($locations)
                    @foreach($locations->sortBy('id') as $location)
                    <tr>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->place->name }}</td>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->details }}</td>
                        <td>{{ $location->floor }}</td>
                        <td>{{ $location->created_at }}</td>
                        <td><a href="{{route('admin.places.edit', $location->id)}}" class="btn btn-info">Edit</a></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$locations->render()}}
            </div>
        </div>
    </div>
</div>
@endsection
