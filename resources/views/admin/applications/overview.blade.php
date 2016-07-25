@extends('layouts.admin')

@section('title', 'Alle Bewerbungen anzeigen')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
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
				<th>Bewerber</th>
				<th>Unternehmen</th>
				<th>Veranstaltung</th>
				<th>Erstellt am</th>
				<th>Aktion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($applications as $application)
				<tr>
					<td>{{ $application->id }}</td>
					<td>{{ $application->user->username }}</td>
					<td>{{ $application->company->name }}</td>
					<td>{{ $application->event->name }}</td>
					<td>{{ $application->created_at }}</td>
					<td>
						{!! HTML::imageLink('admin/applications/'. $application->id .'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
						@if(! $application->deleted_at) 
							{!! HTML::imageLink('admin/applications/'. $application->id .'/delete', 'assets/img/icons/erase.png', 'Löschen', ['title' => 'Löschen']) !!}
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop

