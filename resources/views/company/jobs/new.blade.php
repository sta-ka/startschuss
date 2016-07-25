@extends('layouts.company')

@section('title', 'Neues Stellenangebot veröffentlichen')

@section('content')
	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span8">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'company/jobs/create/'. $company->id]) !!}
			<div class="span6 alpha">
				<div class="form-group">
					{!! Form::label('title', 'Titel/Kurzinfo') !!}
					{!! Form::text('title', Input::old('title'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="span3 alpha">
					<div class="form-group">
						{!! Form::label('location', 'Einsatzort')  !!}
						{!! Form::text('location', Input::old('location'), ['class' => 'form-control input-sm']) !!}
					</div>
				</div>
				<div class="span3 omega">
					<div class="form-group">
						{!! Form::label('start_date', 'Beginn der Beschäftigung') !!}
						{!! Form::text('start_date', Input::old('start_date'), ['class' => 'form-control input-sm']) !!}
					</div>
				</div>
			</div>
			<div class="span8 alpha">
				<div class="form-group">
					{!! Form::label('description', 'Stellenbeschreibung') !!}
					{!! Form::textarea('description', Input::old('description'), ['class' => 'form-control input-sm', 'rows' => 12]) !!}
				</div>
				<div class="form-group">
					{!! Form::label('requirements', 'Anforderungen') !!}
					{!! Form::textarea('requirements', Input::old('requirements'), ['class' => 'form-control input-sm', 'rows' => 12]) !!}
				</div>
				<div>
					{!! Form::submit('Veröffentlichen', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>	
	</div>
	<div class="span2 omega">
		&nbsp;
	</div>
@stop