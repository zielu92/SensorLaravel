@extends('layouts.app')

@section('content')
    <div class="col-lg-12 bottom-air">
        <div class="pull-left">
            <h1>Add Device</h1>
        </div>
        {!! Form::model($device, ['method'=>'POST', 'action'=>['AdminDeviceController@store', $device->id]]) !!}
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('location', 'Location') !!}
                {!! Form::text('location', null, ['class'=>'form-control']) !!}
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
                {!! Form::submit('EDIT', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
