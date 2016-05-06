@extends('layouts.applicant')

@section('title', 'Ausbildung hinzufügen')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
	</div>
	<div class="span8">
	
		<div class="span8 alpha ">
			{!! HTML::link('applicant/profile/add-experience', 'Hinzufügen', ['class' => 'btn btn-success'])!!}
			<br>
			<br>
		</div>

		@foreach($experiences as $experience)
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

			<div class="pull-right">
				{!! HTML::link('applicant/profile/edit-experience/'.$experience->id, 'Bearbeiten', ['class' => 'btn btn-success btn-xs']) !!}
				{!! HTML::link('applicant/profile/delete-experience/'.$experience->id, 'Löschen', ['class' => 'btn btn-danger btn-xs']) !!}
				<br>
				<br>
			</div>

			<hr>
		@endforeach

	</div>
	<div class="span1 omega">
		&nbsp;
	</div>
@stop