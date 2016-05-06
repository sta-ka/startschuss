@extends('layouts.applicant')

@section('title', 'Ausbildung hinzufügen')

@section('content')
	<div class="span3 alpha">
		@include('applicant.profile.partials.nav_bar')
	</div>
	<div class="span8">
	
		<div class="span8 alpha ">
			{!! HTML::link('applicant/profile/add-education', 'Hinzufügen', ['class' => 'btn btn-success'])!!}
			<br>
			<br>
		</div>

		@foreach($educations as $education)
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

			<div class="pull-right">
				{!! HTML::link('applicant/profile/edit-education/'.$education->id, 'Bearbeiten', ['class' => 'btn btn-success btn-xs']) !!}
				{!! HTML::link('applicant/profile/delete-education/'.$education->id, 'Löschen', ['class' => 'btn btn-danger btn-xs']) !!}
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