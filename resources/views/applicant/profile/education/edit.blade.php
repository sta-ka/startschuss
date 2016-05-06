@extends('layouts.applicant')

@section('title', 'Ausbildung hinzufügen')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
	</div>
	<div class="span8">
		@include('partials/validation_errors')

		{!! Form::model($education, ['url' => 'applicant/profile/update-education/'.$education->id]) !!}
			<div class="span6 alpha">
				<div class="span3 alpha form-group">
					{!! Form::label('university', 'Hochschule') !!}
					{!! Form::text('university', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="span3 alpha form-group">
					{!! Form::label('branch_of_study', 'Fachrichtung') !!}
					{!! Form::text('branch_of_study', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="span6 alpha form-group">
					{!! Form::label('key_aspects', 'Schwerpunkte') !!}
					{!! Form::textarea('key_aspects', null, ['class' => 'form-control input-sm', 'rows' => 3]) !!}
				</div>
				<div class="span4 alpha">
					<p>Von:</p>
					<div class="span2 alpha form-group">
						{!! Form::month('month_start', null, ['class' => 'form-control input-sm']) !!}
					</div>
					<div class="span2 omega form-group">
						{!! Form::selectRange('year_start', date('Y'), '1980', null, ['class' => 'form-control input-sm']) !!}
					</div>
				</div>
				<div class="span6 alpha">
					<p>Bis:</p>
					<div class="span2 alpha form-group">
						{!! Form::month('month_end', null, ['class' => 'form-control input-sm']) !!}
					</div>
					<div class="span2 form-group">
						{!! Form::year('year_end', null, ['class' => 'form-control input-sm']) !!}
					</div>
					<div class="span2 omega form-group">
						{!! Form::checkbox('to_date', '1', null, ['id' => 'to-date']) !!} Bis heute
					</div>
				</div>
			</div>

			<div class="span8 alpha">
				<div>
					{!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span1 omega">
		&nbsp;
	</div>
@stop