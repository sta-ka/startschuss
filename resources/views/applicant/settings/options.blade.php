@extends('layouts.applicant')

@section('title', 'Optionen')

@section('content')
    <div class="span3 alpha">
        @include('applicant.settings.nav_bar')
    </div>
    <div class="span6">
        @include('partials/validation_errors')

        {!! Form::open(['url' => 'applicant/settings/update-options']) !!}
        <div class="span3 alpha">
            <div class="form-group span3 alpha">
                {!! Form::label('region_id', 'Region')!!}
                {!! Form::select('region_id', $regions, settings('region') ?: Input::old('region_id'), ['class' => 'form-control input-sm']) !!}
            </div>

            <div>
                {!! Form::submit('Speichern', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="span3 omega">
        &nbsp;
    </div>
@stop