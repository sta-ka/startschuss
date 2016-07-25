@extends('layouts.admin')

@section('title', 'Alle Veranstalter anzeigen')

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
		<div>
			{!! HTML::link('admin/organizers/new', 'Neuer Veranstalter', ['class' => 'btn btn-success']) !!}
			<br><br>
		</div>	
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Info</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($organizers as $organizer)
					<tr>
						<td>{{ $organizer->id }}</td>
						<td>{{ $organizer->name }}</td>
						<td>
							@if($organizer->featured)
								<span class="label label-success">Featured</span>
							@endif
							@if($organizer->premium)
								<span class="label label-success">Premium</span>
							@endif
						</td>
						<td>
							{!! HTML::imageLink('admin/organizers/'. $organizer->id .'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							
						@if(! $organizer->deleted_at)
							{!! HTML::imageLink('veranstalter/'. $organizer->slug, 'assets/img/icons/show.png', 'Anzeigen', ['target' => '_blank', 'title' => 'Anzeigen']) !!}
							{!! HTML::imageLink('admin/organizers/'. $organizer->id .'/delete', 'assets/img/icons/erase.png', 'Löschen', ['title' => 'Löschen']) !!}
						@endif
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

