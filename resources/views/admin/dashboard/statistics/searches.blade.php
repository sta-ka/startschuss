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
				"aoColumns": [
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
		@include('admin.dashboard.statistics.nav_bar')
	</div>	
	<div class="span10 omega">
		<h3>Top Suchanfragen (nach Städten)</h3>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Suchanfrage</th>
					<th>Anzahl</th>
				</tr>
			</thead>
			<tbody>
				@foreach($top_searches as $search)
					<tr>
						<td>{{ $search->info }}</td>
						<td>{{ $search->total_searches }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

        <br/>
        <br/>

		<h3>Suchanfragen (nach Städten)</h3>
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>IP</th>
					<th>Suchanfrage</th>
					<th>Datum</th>
				</tr>
			</thead>
			<tbody>
				@foreach($searches as $search)
					<tr>
						<td>{{ $search->ip_address }}</td>
						<td>{{ $search->info }}</td>
						<td>{{ $search->created_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop