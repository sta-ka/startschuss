@extends('layouts.organizer')

@section('title', 'Bewerber anzeigen')

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('organizer/applications', 'Übersicht') !!}</li>
			<li>{!! HTML::link('organizer/applications/event/'. $event->id, 'Bewerbungen - '. $event->name) !!}</li>
			<li class="active">Bewerber - {{ $applicant->name }}</li>
		</ol>
	</div>
	<div class="span1 alpha">
		&nbsp;
	</div>
	<div class="span8">
		<h2>Ihr Profil</h2>

		@if(count($applicant->experiences))
			<h3>Berufserfahrung</h3>
			@foreach($applicant->experiences as $experience)
				<div class="span 6 alpha experience">
					<p class="timespan">
						{{ Date::monthYearDate($experience->start_date) }} 
						bis 
						{{ $experience->to_date ? 'heute' : Date::monthYearDate($experience->end_date) }}
					</p>
					<p class="company">{{ $experience->company }}</p>
					<p>
						<strong>Branche:</strong> {{ $experience->industry }}<br>
						<strong>Beschreibung:</strong> {{ $experience->job_description }}
					</p>
				</div>

				<hr>
			@endforeach
		@endif

		@if(count($applicant->educations))
			<h3>Ausbildung</h3>
			@foreach($applicant->educations as $education)
				<div class="span 6 alpha education">
					<p class="timespan">
						{{ Date::monthYearDate($education->start_date) }} 
						bis 
						{{ $education->to_date ? 'heute' : Date::monthYearDate($education->end_date) }}
					</p>
					<p class="university">{{ $education->university }}</p>
					<p>
						<strong>Fachrichtung:</strong> {{ $education->branch_of_study }}<br>
						<strong>Schwerpunkte:</strong> {{ $education->key_aspects }}
					</p>
				</div>

				<hr>
			@endforeach
		@endif
	</div>

	<div class="span3 omega">
		&nbsp;
	</div>
@stop