@extends('layouts.app')

@section('content')
<div class="col-lg-12">
    <h1>Add Device</h1>
</div>
{!! Form::open(['method'=>'POST', 'action'=>'AdminDeviceController@store']) !!}
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-md-3">
        {!! Form::label('place_id', 'Place') !!}
        {!! Form::select('place_id', ['' => "Choose"] + $place, null, ['class'=>'form-control placeList']) !!}
    </div>

    <div class="form-group col-md-3">
        {!! Form::label('location_id', 'Location') !!}
        {!! Form::select('location_id', ['' => ''], null, ['class'=>'form-control brand-list']) !!}
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
@section('scripts')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    $(function() {
        $('.placeList option').on('click', function() {
            var place_id = $(this).val();
            $.ajax({
                url: 'admin/places/location/' + place_id,
                data: {
                    _method: 'GET',
                },
                type: "POST",
                success: function(data) {
                    if (!data.error) {
                        var locationList = JSON.parse(data);
                        var output;
                        if (locationList.location == "none") {
                            $("#location_id").html("<option value=''></option>");
                        } else {
                            for (var i in locationList) {
                                output += "<option value='" + locationList[i].id + "'>" + locationList[i].location + "</option>";
                            }
                            $("#location_id").html(output);
                        }
                    }
                }
            });
        });
    });
</script>
@endsection
