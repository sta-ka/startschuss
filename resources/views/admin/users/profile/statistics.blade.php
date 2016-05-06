@extends('layouts.admin')

@section('title', 'Nutzer anzeigen')

@section('content')
	@include('admin.users.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.users.profile.partials.nav_bar')
	</div>
	<div class="span9 omega">
		<div class="span7 alpha">
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
					@if($logins->count())
						@foreach($logins as $login)
							<tr>
								<td>{{ $login->username }}</td>
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
					@else
						<tr>
							<td colspan="4">Keine Einträge vorhanden.</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
@stop