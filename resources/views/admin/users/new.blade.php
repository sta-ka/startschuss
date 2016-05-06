@extends('layouts.admin')

@section('title', 'Neuen Nutzer anlegen')

@section('content')
	<div class="span3 alpha">
		&nbsp;
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'admin/users/create-user']) !!}

		<fieldset>
			<legend>Nuterbezogene Daten</legend>
			<div class="span3 alpha">
				<div class="input-group input-group-sm">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					{!! Form::text('username', Input::old('username'), ['class' => 'form-control input-sm', 'placeholder' => 'Login']) !!}
				</div>
			</div>
			<div class="span3 omega">
				<div class="input-group input-group-sm">
					<span class="input-group-addon">@</span>
					{!! Form::text('email', Input::old('email'), ['class' => 'form-control input-sm', 'placeholder' => 'E-Mail']) !!}
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Weitere Daten</legend>
			<?php $group = ['2' => 'Veranstalter', '3' => 'Unternehmen', '4' => 'Bewerber' ]; ?>
			
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('group', 'Gruppe')!!}
					{!! Form::select('group', $group, Input::old('group'), ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha">
				{!! Form::submit('Erstellen', ['class' => 'btn btn-primary btn-sm']) !!}
			</div>
		</fieldset>


		{!! Form::close() !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop