@extends('layouts.applicant')

@section('title', 'Allgemeine Daten bearbeiten')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
	</div>
	<div class="span8">
		@include('partials/validation_errors')

		{!! Form::model($applicant, ['url' => 'applicant/profile/update-basics']) !!}
			<div class="span6 alpha">
				<div class="span3 alpha">
					<div class="form-group">
						{!! Form::label('name', 'Name')!!}
						{!! Form::text('name', null, ['class' => 'form-control input-sm']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('birthday', 'Geburtstag')!!}
						{!! Form::text('birthday', null, ['class' => 'form-control input-sm']) !!}
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