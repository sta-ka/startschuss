@extends('layouts.organizer')

@section('title', 'Veranstaltungsprogramm bearbeiten')

@section('content')
	@include('organizer.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('organizer.events.profile.partials.nav_bar')
	</div>
	<div class="span9 omega">
		@include('partials/validation_errors')

		{!! Form::model($event, ['url' => 'organizer/profile/'. $event->id .'/update-program']) !!}
			<div class="span7 alpha">
				<div class="form-group">
					{!! Form::label('program', 'Programm') !!}
					{!! Form::textarea('program', null, ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
				<div>
					{!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
@stop