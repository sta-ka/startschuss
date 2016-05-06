@extends('layouts.admin')

@section('title', 'Alle Nutzer anzeigen')

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
	<div>
		{!! HTML::link('admin/users/new', 'Neuen Nutzer', ['class' => 'btn btn-success']) !!}
		<br>
		<br>
	</div>
	<div>
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Gruppe</th>
					<th>Login</th>
					<th>E-Mail</th>
					<th width="200px">Status</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				<?php $group = [
								'1' => 'Admin',
								'2' => 'Veranstalter',
								'3' => 'Unternehmen',
								'4' => 'Bewerber'
							]; ?>

				@foreach($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $group[$user->group[0]->id] }}</td>
						<td>{{ $user->username }}</td>
						<td>
							<span title="{{ $user->email }}">{{ Str::limit($user->email, 20) }}</span>
						</td>
						<td>
							@if($user->deleted_at) 
								<span class="label label-danger">Gelöscht</span>
							@else
								@if($user->throttle)
									@if($user->throttle->banned) 
										<span class="label label-danger">Gespeert</span>
									@elseif($user->suspended)
										<span class="label label-warning">Suspendiert</span>
									@else
										@if($user->activated)
											<span class="label label-success">Aktiv</span>
										@else
											<span class="label label-warning">N. aktiv</span>
										@endif								
									@endif
								@else
									@if($user->activated)
										<span class="label label-success">Aktiv</span>
									@else
										<span class="label label-warning">N. aktiv</span>
									@endif
								@endif
							@endif
						</td>
						<td>
							{!! HTML::imageLink('admin/users/'.$user->id.'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							{!! HTML::imageLink('admin/users/'.$user->id.'/force-login', 'assets/img/icons/login_key.png', 'Login', ['title' => 'Login']) !!}
							{!! HTML::imageLink('admin/users/'.$user->id.'/send-mail', 'assets/img/icons/message.png', 'Mail senden', ['title' => 'Mail senden']) !!}
							
							@if( ! $user->deleted_at)
								{!! HTML::imageLink('admin/users/'.$user->id.'/delete', 'assets/img/icons/erase.png', 'Löschen', ['title' => 'Löschen']) !!}
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop

