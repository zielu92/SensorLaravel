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
{{--            TODO: Location and place edit--}}
            <div class="form-group col-md-6">
                {!! Form::label('mac', 'MAC') !!}
                {!! Form::text('mac', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('password', 'Device password') !!}
                {!! Form::text('password', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-6 specification">
                {!! Form::label('isInside', 'Is it installed inside?') !!}
                <div class="col-lg-6">
                    {!! Form::radio('isInside', true,
                     ['id' => 'Yes', 'class'=>'form-check-input'])  !!}
                    <label class="form-check-label" for="Yes">
                        Yes
                    </label>
                </div>
                <div class="col-lg-6">
                    {!! Form::radio('isInside', false,
                    ['id' => 'No', 'class'=>'form-check-input']) !!}
                    <label class="form-check-label" for="No">
                        No
                    </label>
                </div>
            </div>

            <div class="form-group col-md-12">
                {!! Form::submit('EDIT', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
