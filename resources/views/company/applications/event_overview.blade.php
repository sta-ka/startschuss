@extends('layouts.company')

@section('title', 'Alle Bewerbungen anzeigen')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				"aaSorting": [[ 1, "desc" ]],
				'aoColumns': [
					null,
					{ 'sType': 'date-eu' },
					null,
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
			<li class="active">Bewerbungen - {{ $event->name }}</li>
		</ol>
	</div>
	@if($event->interviews_locked)
		<div>
			{!! Html::link('company/applications/event-interviews/'. $event->id, 'Einzelgesprächstermine anzeigen', ['class' => 'btn btn-primary btn-sm']) !!}
			<hr>
		</div>
	@endif

	<div class="span10 alpha">
		@if($applications->count())
			<table id="datatable" class="table table-hover">
				<thead>
					<tr>
						<th>Bewerber</th>
						<th>Erstellt am</th>
						<th>Status</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($applications as $application)
						<tr>
							<td>
								{{ $application->user->username }}
								{!! HTML::imageLink('company/applications/applicant/'.$application->event->id.'/'.$application->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
							</td>
							<td>{{ $application->created_at }}</td>
							<td>
								@if($application->accepted_by_company === null && $application->rejected_by_company === null)
									<span class="label label-warning">Nicht bearbeitet</span>
								@elseif($application->accepted_by_company)
									<span class="label label-success">Bewerber eingeladen</span>
								@elseif($application->rejected_by_company)
									<span class="label label-success">Abgelehnt</span>
								@endif	
							</td>
							<td>
								{!! HTML::imageLink('company/applications/show/'.$application->event->id.'/'.$application->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>Bisher sind noch keine Bewerbungen eingegangen.</p>
		@endif
	</div>
@stop

