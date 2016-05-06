@extends('layouts.applicant')

@section('title', 'Foto bearbeiten')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		@if($applicant->photo)
			{!! HTML::image('uploads/photos/small/'.$applicant->photo, $applicant->name) !!}
			<br><br>
			{!! HTML::link('applicant/profile/delete-photo', 'Foto löschen', ['class' => 'btn btn-danger btn-sm']) !!}
		@else
			<p id="filename"></p>
			
			{!! Form::open(['url' => 'applicant/profile/update-photo', 'files' => true]) !!}
				<div class="form-group">
					<button class="btn btn-default btn-sm" id="browse-file">Foto auswählen</button>
					{!! Form::file('photo', ['id' => 'photo']) !!}
				</div>

				<div>
					{!! Form::submit('Hochladen', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			{!! Form::close() !!}
		@endif
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop