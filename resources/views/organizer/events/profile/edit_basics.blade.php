@extends('layouts.organizer')

@section('title', 'Veranstaltungsdaten bearbeiten')


@section('content')
	@include('organizer.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('organizer.events.profile.partials.nav_bar')
	</div>
	<div class="span8">
		@include('partials/validation_errors')

		{!! Form::model($event, ['url' => 'organizer/profile/'.$event->id.'/update-basics']) !!}
			<div class="span6 alpha">
				<div class="span3 alpha">
					<div class="form-group">
						{!! Form::label('name', 'Name')!!}
						{!! Form::text('name', null, ['class' => 'form-control input-sm', 'disabled' => 'disabled']) !!}
					</div>
				</div>
				<div class="span3 alpha">
					<div class="form-group">
						{!! Form::label('location', 'Ort')!!}
						{!! Form::text('location', null, ['class' => 'form-control input-sm', 'disabled' => 'disabled']) !!}
					</div>
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group span2 alpha">
					{!! Form::label('start_date', 'Startdatum')!!}
					{!! Form::text('start_date', null, ['class' => 'form-control input-sm', 'disabled' => 'disabled']) !!}
				</div>
				<div class="form-group span2">
					{!! Form::label('end_date', 'Enddatum')!!}
					{!! Form::text('end_date', null, ['class' => 'form-control input-sm', 'disabled' => 'disabled']) !!}
				</div>
			</div>

			<div class="span6 alpha">
				<div class="span3 alpha">
					<div class="form-group">
						{!! Form::label('opening_hours1', 'Öffnungszeiten')!!}
						{!! Form::text('opening_hours1', null, ['class' => 'form-control input-sm']) !!}
						{!! Form::text('opening_hours2', null, ['class' => 'form-control input-sm']) !!}
					</div>
				</div>

				<div class="span3 omega">
					<div class="form-group">
						{!! Form::label('admission', 'Eintritt') !!}
						{!! Form::text('admission', null, ['class' => 'form-control input-sm']) !!}
					</div>
				</div>
			</div>

			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('specific_location1', 'Veranstaltungsort') !!}
					{!! Form::text('specific_location1', null, ['class' => 'form-control input-sm']) !!}
					{!! Form::text('specific_location2', null, ['class' => 'form-control input-sm']) !!}
					{!! Form::text('specific_location3', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>

			<div class="span8 alpha">
				<div class="form-group">
					{!! Form::label('profile', 'Profil') !!}
					{!! Form::textarea('profile', null, ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
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