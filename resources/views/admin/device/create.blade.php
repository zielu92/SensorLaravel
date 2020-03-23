@extends('layouts.app')

@section('content')
    <div class="col-lg-12 bottom-air">
        <div class="pull-left">
            <h1>Add Device</h1>
        </div>
        {!! Form::open(['method'=>'POST', 'action'=>'DeviceController@store']) !!}
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('location_id', 'Location') !!}
                {!! Form::select('location_id', $location, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('mac', 'MAC') !!}
                {!! Form::text('mac', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-md-12">Future features??</div>
            <div class="form-group col-md-6">
                {!! Form::label('pass', 'Password to device') !!}
                {!! Form::text('pass', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('pass', 'API') !!}
                {!! Form::text('pass', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('pass', 'Comment') !!}
                {!! Form::text('pass', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::submit('ADD', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
