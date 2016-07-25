@extends('layouts.admin')

@section('title', 'Alle Veranstaltungen anzeigen')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				"aoColumns": [
					null,
					null,
					null,
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
	@if($duplicates->count()) 
		<div class="span8 alpha alert alert-danger">
			<h4 class="alert-heading">Folgende Messen können nicht eindeutig zugeordnet werden!</h4>
			<ul>
			@foreach($duplicates as $event)
				<li>{{ $event->name .' ('. $event->slug .')' }}</li>
			@endforeach
			</ul>
		</div>
	@endif
	
	<div class="span8 alpha ">
		{!! HTML::link('admin/events/new', 'Neue Veranstaltung', ['class' => 'btn btn-success']) !!}
		<br>
		<br>
	</div>

	<table id="datatable" class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>User</th>
				<th>Name</th>
				<th>Datum</th>
				<th>Info</th>
				<th>Aktion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($events as $event)
				<tr>
					<td>{{ $event->id }}</td>
					<td>
						@if(isset($event->user->username))
							{!! HTML::link('admin/users/'. $event->user->id .'/show', $event->user->username) !!}
						@else
							-
						@endif
					</td>
					<td>{{ $event->name }}</td>
					<td>{{ $event->start_date }}</td>
					<td>
						@if($event->deleted_at) 
							<span class="label label-danger">Gelöscht</span>
						@else
							@if($event->visible)
								<span class="label label-success">Sichtbar</span>
							@else 
								<span class="label label-warning">N. sichtbar</span>
							@endif
						@endif
					</td>
					<td>
						{!! HTML::imageLink('admin/events/'. $event->id .'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
						{!! HTML::imageLink('admin/events/new/'. $event->id, 'assets/img/icons/plus.png', 'Neue Veranstaltung', ['title' => 'Neue Veranstaltung']) !!}
							
						@if( ! $event->deleted_at)
							{!! HTML::imageLink('admin/events/'. $event->id .'/delete', 'assets/img/icons/erase.png', 'Löschen', ['title' => 'Löschen']) !!}
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop

