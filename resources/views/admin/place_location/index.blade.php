@extends('layouts.app')

@section('content')
    <div class="col-lg-12 bottom-air">
        <div class="pull-left">
            <h1>Places and locations</h1>
        </div>
        <div class="col-md-12">
            <h4>Add new place</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'PlaceController@store', 'class'=>'form-row']) !!}
            <div class="form-group col-md-6">
                {!! Form::label('name', 'Place name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('details', 'Details') !!}
                {!! Form::text('details', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-grop col-md-6">
                <br>
                {!! Form::submit('Add new place', ['class'=>'btn btn-primary ']) !!}
            </div>
            {!! Form::close() !!}

            <div class="clearfix"></div>
            <h4>Add new location</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'LocationController@store', 'class'=>'form-row']) !!}

            <div class="form-group col-md-4">
                {!! Form::label('place_id', 'Place') !!}
                {!! Form::select('place_id', $places, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('details', 'Details') !!}
                {!! Form::text('details', null, ['class'=>'form-control']) !!}
            </div>


            <div class="form-group col-md-4">
                {!! Form::label('floor', 'Floor') !!}
                {!! Form::text('floor', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-grop col-md-4">
                <br>
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
                    @foreach($locations->sortByDesc('id') as $location)
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
            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$locations->render()}}
                </div>
            </div>
    </div>
    </div>
@endsection
