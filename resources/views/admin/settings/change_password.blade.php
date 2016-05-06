@extends('layouts.admin')

@section('title', 'Passwort ändern')

@section('content')
	<div class="span3 alpha">
		@include('admin.settings.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'admin/settings/update-password']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('oldpassword', 'Altes Passwort')!!}
					{!! Form::password('oldpassword', ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha">
				<div class="span3 alpha">
					<div class="form-group">
						{!! Form::label('newpassword', 'Neues Passwort')!!}
						{!! Form::password('newpassword', ['class' => 'form-control input-sm']) !!}
					</div>
				</div>
				<div class="span3 omega">
					<div class="form-group">
						{!! Form::label('passwordconfirmation', 'Passwort wiederholen')!!}
						{!! Form::password('passwordconfirmation', ['class' => 'form-control input-sm']) !!}
					</div>
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