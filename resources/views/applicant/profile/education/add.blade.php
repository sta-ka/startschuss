@extends('layouts.applicant')

@section('title', 'Ausbildung hinzufügen')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
	</div>
	<div class="span8">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'applicant/profile/create-education']) !!}
			<div class="span6 alpha">
				<div class="span3 alpha form-group">
					{!! Form::label('university', 'Hochschule') !!}
					{!! Form::text('university', Input::old('university'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="span3 alpha form-group">
					{!! Form::label('branch_of_study', 'Fachrichtung') !!}
					{!! Form::text('branch_of_study', Input::old('branch_of_study'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="span6 alpha form-group">
					{!! Form::label('key_aspects', 'Schwerpunkte') !!}
					{!! Form::textarea('key_aspects', Input::old('key_aspects'), ['class' => 'form-control input-sm', 'rows' => 3]) !!}
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