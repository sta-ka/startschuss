@extends('layouts.organizer')

@section('title', 'Veranstaltungsdaten bearbeiten')

@section('scripts')
	<script type="text/javascript">
		var startDateLabel = $('label[for=start_date]');
		var endDateField = $('#end_date');
		var multiDateField = $('#multi-date');

		if(multiDateField.is(':checked') == false)
		{
			startDateLabel.text('Datum');
			endDateField.parent().css('display', 'none');
			endDateField.val('');
		}

		multiDateField.change(function() {

			if(multiDateField.is(':checked'))
			{
				startDateLabel.text('Startdatum');
				endDateField.parent().fadeIn('slow');
			}
			else
			{
				startDateLabel.text('Datum');
				endDateField.parent().css('display', 'none');
				endDateField.val('');
			}
		});
	</script>	
@stop

@section('content')
	<div class="row">
		<ol class="breadcrumb">
			<li>{!! HTML::link('organizer/profile', 'Übersicht') !!}</li>
			<li class="active">Neue Messe eintragen</li>
		</ol>
	</div>
	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span8">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'organizer/profile/create/'. $event->id ]) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('name', 'Name')!!}
					{!! Form::text('name', Input::old('name', $event->name), ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('multi_date', '1', null, ['id' => 'multi-date']) !!} Mehrtägige Veranstaltung
					</label>
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group span2 alpha">
					{!! Form::label('start_date', 'Startdatum')!!}
					{!! Form::text('start_date', Input::old('start_date'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group span2">
					{!! Form::label('end_date', 'Enddatum')!!}
					{!! Form::text('end_date', Input::old('end_date'), ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group span3 alpha">
					{!! Form::label('location', 'Ort')!!}
					{!! Form::text('location', Input::old('location', $event->location), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group span3 omega">
					{!! Form::label('region_id', 'Region')!!}
					{!! Form::select('region_id', $regions, Input::old('region_id', $event->region_id), ['class' => 'form-control input-sm']) !!}
				</div>
			</div>


			<div class="span6 alpha">
				<div class="form-group span3 alpha">
					{!! Form::label('specific_location1', 'Veranstaltungsort') !!}
					{!! Form::text('specific_location1', Input::old('specific_location1', $event->specific_location1), ['class' => 'form-control input-sm']) !!}
					{!! Form::text('specific_location2', Input::old('specific_location2', $event->specific_location2), ['class' => 'form-control input-sm']) !!}
					{!! Form::text('specific_location3', Input::old('specific_location3', $event->specific_location3), ['class' => 'form-control input-sm']) !!}
				</div>
			</div>

			<div class="span8 alpha">
				<div class="form-group">
					{!! Form::label('profile', 'Profil') !!}
					{!! Form::textarea('profile', Input::old('profile', $event->profile), ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
				<div>
					{!! Form::submit('Erstellen', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span2 omega">
		&nbsp;
	</div>
@stop