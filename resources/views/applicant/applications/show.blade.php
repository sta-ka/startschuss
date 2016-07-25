@extends('layouts.applicant')

@section('title', 'Dashboard')

@section('content')
	<div class="span12 alpha">
		<div>
			{!! HTML::link('applicant/applications', 'Neue Bewerbung', ['class' => 'btn btn-success'])!!}
			<br>
			<br>
		</div>
		<h3>Bewerbungen für Einzelgespräche</h3>
		@if(count($applications))
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Veranstaltung</th>
						<th>Datum</th>
						<th>Unternehmen</th>
						<th>Status</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($applications as $application)
						<tr>
							<td>
								{{ Str::limit($application->event->name, 40) }}
								{!! HTML::imageLink('jobmesse/'. $application->event->slug, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen', 'target' => '_blank']) !!}
							</td>
							<td>{{  Date::monthDate($application->event->start_date, $application->event->end_date, false) }}</td>
							<td>{{ $application->company->name }}</td>
							<td>
								@if($application->rejected_by_organizer) 
									<span class="label label-danger" title="Ihre Bewerbung wurde vom Veranstalter nicht akzeptiert.">Abgelehnt</span>
								@elseif($application->rejected_by_company)
									<span class="label label-danger" title="Ihre Bewerbung wurde vom Unternehmen nicht ausgewählt.">Bewerbung abgelehnt</span>
								@elseif($application->approved_by_organizer || $application->accepted_by_company)
									@if($application->time_of_interview && $application->event->interviews_closed) 
										<span class="label label-success" title="Sie haben eine Einladung zu einem Gespräch erhalten.">Eingeladen</span>
									@elseif($application->accepted_by_company) 
										<span class="label label-success" title="Ihre Bewerbung war erfolgreich, Termin für ein Einzelgespräch folgt.">Erfolgreich</span>
									@else
										<span class="label label-info" title="Ihre Bewerbung wurde vom Veranstalter akzeptiert.">Angenommen</span>
									@endif
								@else 
									<span class="label label-warning" title="Ihre Bewerbung ist in Bearbeitung.">In Bearbeitung</span>
								@endif

							</td>
							<td>
								{!! HTML::imageLink('applicant/applications/'. $application->id .'/show', 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>Es liegen keine Bewerbungen vor.</p>
		@endif
	</div>
@stop