@extends('layouts.applicant')

@section('title', 'Kontaktdaten bearbeiten')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($applicant, ['url' => 'applicant/profile/update-contacts']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('email', 'E-Mail')!!}
					{!! Form::text('email', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('phone', 'Telefon')!!}
					{!! Form::text('phone', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div>
					{!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop