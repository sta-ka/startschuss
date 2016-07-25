@extends('layouts.organizer')

@section('title', 'Kontaktdaten bearbeiten')

@section('content')
	@include('organizer.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('organizer.events.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($event, ['url' => 'organizer/profile/'. $event->id .'/update-contacts']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('website', 'Webseite')!!}
					{!! Form::text('website', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('facebook', 'Facebook')!!}
					{!! Form::text('facebook', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('twitter', 'Twitter')!!}
					{!! Form::text('twitter', null, ['class' => 'form-control input-sm']) !!}
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