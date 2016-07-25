@extends('layouts.applicant')

@section('title', 'Profil anzeigen')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
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
                        <i>({{  Date::diffInMonths($experience->start_date, $experience->end_date) }})</i>
					</p>
					<p class="company">{{ $experience->company }}</p>
					<p>
						<strong>Branche:</strong> {{ $experience->industry }}<br>
						<strong>Beschreibung:</strong> {{ $experience->job_description }}
					</p>
				</div>

				<div class="pull-right">
					{!! HTML::link('applicant/profile/edit-experience/'. $experience->id, 'Bearbeiten', ['class' => 'btn btn-success btn-xs']) !!}
					{!! HTML::link('applicant/profile/delete-experience/'. $experience->id, 'Löschen', ['class' => 'btn btn-danger btn-xs']) !!}
					<br>
					<br>
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
                        <i>({{ Date::diffInMonths($education->start_date, $education->end_date) }})</i>
					</p>
					<p class="university">{{ $education->university }}</p>
					<p>
						<strong>Fachrichtung:</strong> {{ $education->branch_of_study }}<br>
						<strong>Schwerpunkte:</strong> {{ $education->key_aspects }}
					</p>
				</div>

				<div class="pull-right">
					{!! HTML::link('applicant/profile/edit-education/'. $education->id, 'Bearbeiten', ['class' => 'btn btn-success btn-xs']) !!}
					{!! HTML::link('applicant/profile/delete-education/'. $education->id, 'Löschen', ['class' => 'btn btn-danger btn-xs']) !!}
					<br>
					<br>
				</div>

				<hr>
			@endforeach
		@endif
	</div>

	<div class="span1 omega">
		&nbsp;
	</div>
@stop