@extends('layouts.admin')

@section('title', 'Dashboard')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				"aaSorting": [[ 3, "desc" ]],
				"aoColumns": [
					null,
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
		<h3>Letzte Logins</h3>
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>IP</th>
					<th>Info</th>
					<th>Datum</th>
				</tr>
			</thead>
			<tbody>
				@foreach($logins as $login)
					<tr>
						<td>
							@if($login->user_id)
								{{ $login->user->username }}
							@else
								{{ $login->username }}
                            @endif
                        </td>
						<td>{{ $login->ip_address }}</td>
						<td>
							@if($login->success)
								<span class="label label-success">Erfolg</span>
							@else
								<span class="label label-danger">{{ $login->comment or 'Fehlgeschlagen' }}</span>
							@endif
						</td>
						<td>{{ $login->created_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop