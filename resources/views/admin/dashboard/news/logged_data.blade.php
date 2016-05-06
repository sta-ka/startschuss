@extends('layouts.admin')

@section('title', 'Dashboard')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				"aaSorting": [[ 2, "desc" ]],
				'aoColumns': [
					null,
					null,
					{ 'sType': 'date-euro' }
				],
				"fnDrawCallback": function() {
                    $('#datatable_filter input, #datatable_length select').addClass('form-element input-sm');
				}
			});
		});	
	</script>
@stop

@section('content')
	<div class="span2 alpha">
		@include('admin.dashboard.news.nav_bar')
	</div>	
	<div class="span10 omega">
		<h3>Letzte Ereignisse</h3>
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>Ereignis</th>
					<th>IP</th>
					<th>Datum</th>
				</tr>
			</thead>
			<tbody>
				@foreach($logged_data as $data)
					<tr>
						<td>{{ $data->message }}</td>
						<td>{{ $data->ip_address }}</td>
						<td>{{ Date::format($data->created_at, 'datetime') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop