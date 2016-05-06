@extends('layouts.admin')

@section('title', 'Veranstaltungsdaten bearbeiten')

@section('content')
	@include('admin.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.events.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($event, ['url' => 'admin/events/'.$event->id.'/update-general-data']) !!}
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('name', 'Name')!!}
					{!! Form::text('name', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span2 omega">
				<div class="form-group">
					{!! Form::label('location', 'Ort')!!}
					{!! Form::text('location', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group span2 alpha">
					{!! Form::label('start_date', 'Startdatum')!!}
					{!! Form::text('start_date', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group span2">
					{!! Form::label('end_date', 'Enddatum')!!}
					{!! Form::text('end_date', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span3 alpha">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('interviews', '1', null) !!} Einzelgespräche
					</label><br>
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group span3 alpha">
					{!! Form::label('region_id', 'Region')!!}
					{!! Form::select('region_id', $regions, null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group span3 omega">
					{!! Form::label('organizer_id', 'Veranstalter')!!}
					{!! Form::select('organizer_id', $organizers, null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha">
				{!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm']) !!}
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop