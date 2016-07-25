@extends('layouts.organizer')

@section('title', 'Alle Bewerbungen anzeigen')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				"aaSorting": [[ 1, "desc" ]],
				"aoColumns": [
					null,
					{ 'sType': 'date-eu' },
					null,
					null,
					null
				],
				"fnDrawCallback": function() {
					$('#datatable_filter input, #datatable_length select').addClass('form-element input-sm');

				}
			});
		});	
	</script>
@stop

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('organizer/applications', 'Übersicht') !!}</li>
			<li class="active">Bewerbungen - {{ $event->name }}</li>
		</ol>
	</div>
	<div class="span6 alpha">
		@if($event->applications_closed)
			<h3>Bewerbungsphase abgeschlossen</h3>
			<p>Die Bewerbungsphase für diese Veranstaltung ist beendet.</p>
		@else
			<h3>Bewerbungsphase abschließen</h3>
			<p>Hier können sie die Bewerbungsphase abschließen.</p>

			{!! Form::open(['url' => 'organizer/applications/close-applications/'. $event->id]) !!}
				{!! Form::submit('Bewerbungsphase abschließen', ['class' => 'btn btn-primary btn-sm']) !!}
			{!! Form::close() !!}
			<br>
			<br>
		@endif
	</div>

	<div class="span6 omega">
		@if($event->interviews_locked)
			<h3>Terminvergabe abgeschlossen</h3>
			<p>Es können keine weiteren Termine für Einzelgepräche gemacht werden.</p>
		@else
			<h3>Terminvergabe abschließen</h3>
			<p>Haben sie alle Bewerbungen bearbeitet, können Sie hier die Bearbeitung abschließen. Änderungen an den Terminen für Einzelgespräche können dann nicht mehr gemacht werden.</p>

			{!! Form::open(['url' => 'organizer/applications/lock-interviews/'. $event->id]) !!}
				<div class="pull-right">
					{!! Form::submit('Terminvergabe abschließen', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			{!! Form::close() !!}
		@endif
		
		<div class="pull-left">
			{!! Html::link('organizer/applications/event-interviews/'. $event->id, 'Einzelgesprächstermine anzeigen', ['class' => 'btn btn-primary btn-sm']) !!}
		</div>
		<br>
		<br>
	</div>
	<hr>
	<table id="datatable" class="table table-hover">
		<thead>
			<tr>
				<th>Bewerber</th>
				<th>Eingegangen am</th>
				<th>Unternehmen</th>
				<th>Status</th>
				<th>Aktion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($applications as $application)
				<tr>
					<td>
						{{ $application->applicant->name }}
						{!! HTML::imageLink('organizer/applications/applicant/'. $application->event->id .'/'. $application->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
					</td>
					<td>{{ $application->created_at }}</td>
					<td>{{ $application->company->name }}</td>
					<td>
						@if($application->approved_by_organizer === null && $application->rejected_by_organizer === null)
							<span class="label label-warning">Nicht bearbeitet</span>
						@elseif($application->accepted_by_company)
							<span class="label label-success" title="Bewerber wurde vom Unternehmen ausgewählt.">Bewerbung erfolgreich</span>
						@elseif($application->rejected_by_company)
							<span class="label label-warning" title="Bewerbung wurde vom Unternehmen abgeleht.">Bewerbung abgelehnt</span>
						@elseif($application->approved_by_organizer)
							<span class="label label-success" title="Bewerbung wurde an das Unternehmen weitergeleitet.">Weitergeleitet</span>
						@elseif($application->rejected_by_organizer)
							<span class="label label-danger" title="Bewerbung wurde von Ihnen abgelehnt.">Abgelehnt</span>
						@endif

						@if($application->accepted_by_company && ! $application->time_of_interview)
							<span class="label label-warning" title="Termin für ein Einzelgespräch wurde noch nicht vergeben.">Termin fehlt</span>
						@endif	
					</td>
					<td>
						{!! HTML::imageLink('organizer/applications/show/'. $application->event->id .'/'. $application->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop

