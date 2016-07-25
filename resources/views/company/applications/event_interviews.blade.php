@extends('layouts.organizer')

@section('title', 'Einzelgespräche anzeigen')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				"aaSorting": [[ 1, "asc" ]],
				"aoColumns": [
					null,
					{ 'sType': 'date-euro-short' },
					null
				],
				"bFilter": false,
				"bPaginate": false
			});
		});	
	</script>
@stop

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('company/applications', 'Übersicht') !!}</li>
			<li>{!! HTML::link('company/applications/event/'. $event->id, 'Bewerbungen - ' . $event->name) !!}</li>
			<li class="active">Einzelgespräche - Übersicht</li>
		</ol>
	</div>
	<div class="span8 alpha">
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>Bewerber</th>
					<th>Interviewtermin</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($applications as $application)
					@if($application->accepted_by_company)
						<tr>
							<td>{{ $application->user->username }}</td>
							<td>{{ isset($application->time_of_interview) ? Date::format($application->time_of_interview, 'datetime_short'). ' Uhr' : '-' }}</td>
							<td>
								{!! HTML::imageLink('company/applications/show/'. $event->id .'/'. $application->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
							</td>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
@stop

