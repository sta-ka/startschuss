@extends('layouts.admin')

@section('title', 'Neues Unternehmen anlegen')

@section('content')
	<div class="span3 alpha">
		&nbsp;
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'admin/companies/create']) !!}
		<fieldset>
			<legend>Unternehmensdaten</legend>
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('name', 'Name (Kurzform)')!!}
					{!! Form::text('name', Input::old('name'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('full_name', 'Name')!!}
					{!! Form::text('full_name', Input::old('full_name'), ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha">
				{!! Form::submit('Erstellen', ['class' => 'btn btn-primary btn-sm'])!!}
			</div>
		</fieldset>
		{!! Form::close() !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop