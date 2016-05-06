@extends('layouts.admin')

@section('title', 'Veranstaltungsprofil bearbeiten')

@section('content')
	@include('admin.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.events.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($event, ['url' => 'admin/events/'.$event->id.'/update-profile']) !!}
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

			<div class="span6 alpha">
				<label>Zielgruppe</label>
				@foreach($audiences as $item)
					<div class="checkbox">
						<label>
							{!! Form::checkbox('audiences[]', $item, in_array($item, $audience)) !!} {{ $item }}
						</label><br>
					</div>
				@endforeach
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

	<div class="span3 omega">
		&nbsp;
	</div>
@stop