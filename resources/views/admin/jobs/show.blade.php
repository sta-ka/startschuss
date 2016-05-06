@extends('layouts.admin')

@section('title', 'Alle Stellenangebote anzeigen')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				'aoColumns': [
				null,
				null,
				null,
				{ 'sType': 'date-eu' },
				{ 'sType': 'date-eu' },
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
	<table id="datatable" class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Unternehmen</th>
				<th>Name</th>
				<th>Erstellt</th>
				<th>Endet</th>
				<th>Status</th>
				<th>Aktion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($jobs as $job)
				<tr>
					<td>{{ $job->id }}</td>
					<td>{{ $job->company->name or '-' }}</td>
					<td>{{ Str::limit($job->title, 30) }}</td>
					<td>{{ Date::format($job->created_at, 'date') }}</td>
					<td>{{ Date::format($job->expire_at, 'date') }}</td>
					<td>
						@if($job->deleted_at) 
							<span class="label label-danger">Gelöscht</span>
						@elseif($job->expired) 
							<span class="label label-danger">Abgelaufen</span>
						@elseif(! $job->approved)
							<span class="label label-warning">N. freigeschaltet</span>
						@elseif($job->active)
							<span class="label label-success">Aktiv</span>
						@else
							<span class="label label-warning">Deaktiv</span>
						@endif
					</td>
					<td>
						{!! HTML::imageLink('admin/jobs/'.$job->id.'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
						@if(! $job->deleted_at) 
							{!! HTML::imageLink('admin/jobs/'.$job->id.'/delete', 'assets/img/icons/erase.png', 'Löschen', ['title' => 'Löschen']) !!}
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop

