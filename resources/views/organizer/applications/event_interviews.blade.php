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
			<li>{!! HTML::link('organizer/applications/event/'. $event->id, 'Bewerbungen - ' . $event->name) !!}</li>
			<li class="active">Einzelgespräche - Übersicht</li>
		</ol>
	</div>
	<table id="datatable" class="table table-hover">
		<thead>
			<tr>
				<th>Unternehmen</th>
				<th>Interviewtermin</th>
				<th>Bewerber</th>
				<th>Aktion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($applications as $application)
				@if($application->accepted_by_company)
					<tr>
						<td>{{ $application->company->name }}</td>
						<td>{{ isset($application->time_of_interview) ? Date::format($application->time_of_interview, 'datetime_short'). ' Uhr' : '-' }}</td>
						<td>{{ $application->user->username }}</td>
						<td>
							{!! HTML::imageLink('organizer/applications/show/'. $event->id .'/'. $application->id, 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
						</td>
					</tr>
				@endif
			@endforeach
		</tbody>
	</table>
@stop

