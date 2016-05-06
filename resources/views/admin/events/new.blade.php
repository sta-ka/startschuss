@extends('layouts.admin')

@section('title', 'Neue Veranstaltung anlegen')

@section('content')
	<div class="span3 alpha">
		&nbsp;
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		<?php isset($event) ?: $event = ''; ?>

		{!! Form::model($event, ['url' => 'admin/events/create']) !!}

		<fieldset>
			<legend>Veranstaltungsdaten</legend>
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('name', 'Name')!!}
					{!! Form::text('name', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('slug', 'URL')!!}
					{!! Form::text('slug', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group span3 alpha">
					{!! Form::label('location', 'Ort')!!}
					{!! Form::text('location', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="span6 alpha">
					<div class="form-group span2 alpha">
						{!! Form::label('start_date', 'Startdatum')!!}
						{!! Form::text('start_date', null, ['class' => 'form-control input-sm']) !!}
					</div>
					<div class="form-group span2">
						{!! Form::label('end_date', 'Enddatum')!!}
						{!! Form::text('end_date', null, ['class' => 'form-control input-sm']) !!}
					</div>
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group span3 alpha">
					{!! Form::label('region_id', 'Region')!!}
					{!! Form::select('region_id', $regions, Input::old('region_id'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group span3 omega">
					{!! Form::label('organizer_id', 'Veranstalter')!!}
					{!! Form::select('organizer_id', $organizers,  Input::old('organizer_id'), ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span8 alpha">
				<div class="form-group">
					{!! Form::label('profile', 'Name')!!}
					{!! Form::textarea('profile', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha" >
				{!! Form::submit('Erstellen', ['class' => 'btn btn-primary btn-sm']) !!}
			</div>
		</fieldset>
		{!! Form::close() !!}
	</div>

	<div class="span3 omega">
		&nbsp;
	</div>
@stop