@extends('layouts.admin')

@section('title', 'Neuen Veranstalter anlegen')

@section('content')
	<div class="span3 alpha">
		&nbsp;
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'admin/organizers/create']) !!}
		<fieldset>
			<legend>Veranstalterdaten</legend>
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('name', 'Name')!!}
					{!! Form::text('name', Input::old('name'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('slug', 'URL')!!}
					{!! Form::text('slug', Input::old('slug'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div>
					{!! Form::submit('Erstellen', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>
		</fieldset>
		{!! Form::close() !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop