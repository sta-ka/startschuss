@extends('layouts.admin')

@section('title', 'Dashboard')

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
	<div class="span2 alpha">
		@include('admin.dashboard.statistics.nav_bar')
	</div>	
	<div class="span10 omega">
		<h3>Fehlgeschlagene Logins</h3>
		<table id="datatable" class="table table-hover logins">
			<thead>
				<tr>
					<th>Name</th>
					<th>IP</th>
					<th>Versuche</th>
					<th>Letzter Versuch</th>
				</tr>
			</thead>
			<tbody>
				@foreach($login_attempts as $login)
					<tr>
						<td>{{ $login->username }}</td>
						<td>{{ $login->throttle->ip_address }}</td>
						<td>{{ $login->throttle->attempts }}</td>
						<td>{{ $login->throttle->last_attempt_at }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop