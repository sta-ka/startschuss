@extends('layouts.applicant')

@section('title', 'Berufserfahrung hinzufügen')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
	</div>
	<div class="span8">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'applicant/profile/create-experience']) !!}
			<div class="span6 alpha">
				<div class="span3 alpha form-group">
					{!! Form::label('company', 'Unternehmen') !!}
					{!! Form::text('company', Input::old('company'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="span3 alpha form-group">
					{!! Form::label('industry', 'Branche') !!}
					{!! Form::text('industry', Input::old('industry'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="span6 alpha form-group">
					{!! Form::label('job_description', 'Beschreibung') !!}
					{!! Form::textarea('job_description', Input::old('job_description'), ['class' => 'form-control input-sm', 'rows' => 4]) !!}
				</div>
				<div class="span4 alpha">
					<p>Von:</p>
					<div class="span2 alpha form-group">
						{!! Form::month('month_start', Input::old('month_start'), ['class' => 'form-control input-sm']) !!}
					</div>
					<div class="span2 omega form-group">
						{!! Form::year('year_start', Input::old('year_start'), ['class' => 'form-control input-sm']) !!}
					</div>
				</div>
				<div class="span6 alpha">
					<p>Bis:</p>
					<div class="span2 alpha form-group">
						{!! Form::month('month_end', Input::old('month_end'), ['class' => 'form-control input-sm']) !!}
					</div>
					<div class="span2 form-group">
						{!! Form::year('year_end', Input::old('year_end'), ['class' => 'form-control input-sm']) !!}
					</div>
					<div class="span2 omega form-group">
						{!! Form::checkbox('to_date', '1', Input::old('to_date'), ['id' => 'to-date']) !!} Bis heute
					</div>
				</div>
			</div>

			<div class="span8 alpha">
				<div>
					{!! Form::submit('Anlegen', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span1 omega">
		&nbsp;
	</div>
@stop