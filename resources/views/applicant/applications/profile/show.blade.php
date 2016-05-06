@extends('layouts.applicant')

@section('title', 'Bewerbung anzeigen')

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('applicant/applications/show', 'Übersicht') !!}</li>
			<li class="active">Bewerbung - Einzelansicht</li>
		</ol>
	</div>

	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span7">
		@if($application->time_of_interview && $application->event->interviews_locked)
			<h3>Ihre Bewerbung war erfolgreich</h3>
			<p>Termin für ein Einzelgespräch wurde vergeben.</p>
			<p><strong>Termin:</strong> {{ Date::format($application->time_of_interview, 'datetime_short') }} Uhr</p>
			<hr>
		@elseif($application->time_of_interview)
			<h3>Ihre Bewerbung war erfolgreich</h3>
			<p>Termin für ein Einzelgespräch folgt in Kürze.</p>
		@endif
		<p><strong>Veranstaltung:</strong> {{ $application->event->name }}</p>
		<p><strong>Unternehmen:</strong> {{ $application->company->name }}</p>
		<hr>
		<p>{{ $application->cover_letter }}</p>
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop