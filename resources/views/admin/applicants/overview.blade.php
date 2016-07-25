@extends('layouts.admin')

@section('title', 'Alle Bewerber anzeigen')

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
	<div class="span10 alpha">
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Bewerber</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($applicants as $applicant)
					<tr>
						<td>{{ $applicant->id }}</td>
						<td>{{ $applicant->name }}</td>
						<td>
							{!! HTML::imageLink('admin/applicants/'. $applicant->id .'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							{!! HTML::imageLink('admin/applicants/'. $applicant->id .'/delete', 'assets/img/icons/erase.png', 'Löschen', ['title' => 'Löschen']) !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="span2 omega">
		&nbsp;
	</div>
@stop

