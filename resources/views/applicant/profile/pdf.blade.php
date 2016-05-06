<html>
<head>
	<title>Lebenslauf</title>
	<style type="text/css">
		.education .timespan, .experience .timespan {
			color: #9f9f9f;
			margin-top: 0;
			margin-bottom: 0;
			font-size: 14px;
		}

		.education .university, .experience .company {
			margin-top: 0;
			font-size: 18px;
		}		
	</style>
</head>
<body>

	<div class="span10">
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
</body>
</html>
