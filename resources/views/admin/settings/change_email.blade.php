@extends('layouts.admin')

@section('title', 'E-Mail ändern')

@section('content')
	<div class="span3 alpha">
		@include('admin.settings.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'admin/settings/update-email']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('email', 'Neue E-Mail') !!}
					{!! Form::text('email', Input::old('email'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('password', 'Passwort') !!} <i>(Zur Bestätigung)</i>
					{!! Form::password('password', ['class' => 'form-control input-sm']) !!}
				</div>
				<div>
					{!! Form::submit('Ändern', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop