@extends('layouts.company')

@section('title', 'Bewerbung anzeigen')

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('company/applications', 'Übersicht') !!}</li>
			<li>{!! HTML::link('company/applications/event/'. $application->event->id, 'Bewerbungen - '. $application->event->name) !!}</li>
			<li class="active">Bewerbungen - Einzelansicht</li>
		</ol>
	</div>
	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span10 omega">
		<div class="span6 alpha">
			<div class="info-box span6 alpha">
				@if($application->rejected_by_company)
					<p>Bewerbung wurde nicht akzeptiert.</p>
					<br>
				@elseif($application->accepted_by_company)
					<p>Bewerber erhält eine Benachrichtigung über seine erfolgreiche Bewerbung.</p>
					@if($application->time_of_interview && $application->event->interviews_locked)
						<p>Termin für ein Einzelgespräch wurde vergeben.</p>
						<p><strong>Termin:</strong> {{ Date::format($application->time_of_interview, 'datetime_short') }} Uhr</p>
					@elseif($application->time_of_interview)
						<p>(Vorläufiger) Termin für ein Einzelgespräch wurde vergeben.</p>
						<p><strong>Termin:</strong> {{ Date::format($application->time_of_interview, 'datetime_short') }} Uhr</p>
					@endif
				@else
					<p>Hier können Sie die Bewerbung einsehen und bearbeiten.</p>
					<br>
					{!! HTML::link('company/applications/reject-application/'. $application->event->id .'/'. $application->id, 'Bewerbung ablehnen', ['class' => 'btn btn-danger btn-sm']) !!}
					{!! HTML::link('company/applications/accept-application/'. $application->event->id .'/'. $application->id, 'Bewerbung akzeptieren', ['class' => 'btn btn-success btn-sm']) !!}
				@endif
			</div>
		</div>
		<div class="span7 alpha">
			<h3>Bewerbung</h3>
			<p><strong>Bewerber:</strong> {{ $application->user->username }}</p>
			<hr>
			<p><strong>Anschreiben</strong></p>
			<p>{{ $application->cover_letter }}</p>
		</div>
	</div>
@stop