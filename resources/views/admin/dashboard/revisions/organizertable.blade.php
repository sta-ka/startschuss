@extends('layouts.admin')

@section('title', 'Dashboard')

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				"iDisplayLength": 25,
				"aaSorting": [[ 4, "desc" ]],
				'aoColumns': [
					null,
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
	@include('admin.dashboard.revisions.partials.breadcrumb', ['table' => 'Veranstalter'])

	<div>
		<h3>Letzte Änderungen</h3>
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th title="Geändert durch">Nutzer</th>
					<th>Geändertes Feld</th>
					<th>Alter Wert</th>
					<th>Neuer Wert</th>
					<th>Datum</th>
				</tr>
			</thead>
			<tbody>
				@foreach($organizers as $organizer)
					@foreach($organizer->revisionHistory as $history)
						<tr>
							<td title="Geändert durch">{!! HTML::link('admin/users/'.$history->user_id.'/show', $user_list[$history->user_id]) !!}</td>
							<td>{!! HTML::link('admin/organizers/'.$history->revisionable_id.'/show', $organizer->name) !!} - {{ $history->fieldName() }}</td>
							<td>{{ Str::limit($history->oldValue(), 180) }}</td>
							<td>{{ Str::limit($history->newValue(), 180) }}</td>
							<td>{{ Date::format($history->created_at, 'datetime') }}</td>
						</tr>
					@endforeach
				@endforeach
			</tbody>
		</table>
	</div>
@stop