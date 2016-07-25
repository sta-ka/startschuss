@extends('layouts.organizer')

@section('title', 'Bewerbung anzeigen')

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('organizer/applications', 'Übersicht') !!}</li>
			<li>{!! HTML::link('organizer/applications/event/'. $application->event->id, 'Bewerbungen - '. $application->event->name) !!}</li>
			<li class="active">Bewerbungen - Einzelansicht</li>
		</ol>
	</div>
	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span10 omega">
		<div class="span6 alpha">
			@include('partials/validation_errors')

			<div class="info-box span6 alpha">
				@if($application->accepted_by_company)
					<p>Bewerber wurde vom Unternehmen ausgewählt.</p>
					<br>
					@if($application->time_of_interview)
						<p>Termin für ein Einzelgespräch vergeben.</p>
						<p><strong>Termin:</strong> {{ Date::format($application->time_of_interview, 'datetime_short') }} Uhr</p>
						@if($event->interviews_locked == false)
							<br>
							{!! Form::open(['url' => 'organizer/applications/rearrange-interview/'. $application->event->id .'/'. $application->id]) !!}
									{!! Form::submit('Termin ändern', ['class' => 'btn btn-primary btn-sm']) !!}
							{!! Form::close() !!}
							{!! Form::open(['url' => 'organizer/applications/delete-interview/' .$application->event->id .'/'. $application->id]) !!}
									{!! Form::submit('Termin löschen', ['class' => 'btn btn-danger btn-sm']) !!}
							{!! Form::close() !!}
						@endif
					@else
						<p>Hier können Sie jetzt den Termin für das Einzelgespräch festlegen.</p>
						{!! Form::open(['url' => 'organizer/applications/arrange-interview/'. $application->event->id .'/'. $application->id]) !!}
							<div class="span2 alpha">
								<div class="form-group">
									{!! Form::label('date', 'Datum')!!}
									{!! Form::select('date', Date::diff($event->start_date, $event->end_date), Input::old('date'), ['class' => 'form-control input-sm']) !!}
								</div>
							</div>
							<div class="span3 omega">
								<div class="span1 alpha form-group">
									{!! Form::label('hour', 'Stunde')!!}
									{!! Form::selectRange('hour', 8, 20, Input::old('hour'), ['class' => 'form-control input-sm']) !!}
								</div>
								<div class="span1 alpha form-group">
									<?php $minutes = [0 => '00', 5 => '05', '10' => 10, '20' => 20, '25' => 25, '30' => 30, '35' => 35, '40' => 40, '45' => 45, '50' => 50, '55' =>55]; ?>
									{!! Form::label('minute', 'Minute')!!}
									{!! Form::select('minute', $minutes, Input::old('minute'), ['class' => 'form-control input-sm']) !!}
								</div>
							</div>
							<div>
								{!! Form::submit('Termin anlegen', ['class' => 'btn btn-primary btn-sm']) !!}
							</div>
						{!! Form::close() !!}
					@endif

				@elseif($application->rejected_by_company)
					<p>Bewerbung wurde vom Unternehmen abgelehnt.</p>
				@elseif($application->rejected_by_organizer)
					<p>Bewerbung wurde nicht akzeptiert.</p>
					<br>
				@elseif($application->approved_by_organizer)
					<p>Bewerbung wurde akzeptiert und wird nun an das entsprechende Unternehmen weitergeleitet.</p>
				@else
					<p>Hier können Sie die Bewerbung einsehen und bearbeiten.</p>
					<br>
					{!! HTML::link('organizer/applications/disapprove-application/'. $application->event->id .'/'. $application->id, 'Bewerbung ablehnen', ['class' => 'btn btn-danger btn-sm']) !!}
					{!! HTML::link('organizer/applications/approve-application/'. $application->event->id .'/'. $application->id, 'Bewerbung akzeptieren', ['class' => 'btn btn-success btn-sm']) !!}
				@endif
			</div>
		</div>
		<div class="span7 alpha">
			<h3>Bewerbung</h3>
			<p><strong>Bewerber:</strong> 
				{{ $application->applicant->name }}
				{!! HTML::imageLink('organizer/applications/applicant/'. $application->event->id .'/'. $application->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
			</p>
			<hr>
			<p><strong>Anschreiben</strong></p>
			<p>{{ $application->cover_letter }}</p>
			<hr>
			<p><strong>Kommentar</strong></p>
			<p>{{ $application->comment }}</p>
		</div>
		
	</div>
@stop