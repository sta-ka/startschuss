@extends('layouts.admin')

@section('title', 'Einzelgespräche verwalten')

@section('scripts')
	<script src="{{ URL::asset('assets/js/backend/ajaxparticipants.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#datatable').dataTable({
				"oLanguage": {
					"sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
				},
				"aoColumns": [
					null,
					{ 'sType': 'form-input' }
				],
				"iDisplayLength": 25,
				"fnDrawCallback": function() {
                    $('#datatable_filter input, #datatable_length select').addClass('form-element input-sm');
				}
			});
		});	
	</script>
@stop

@section('content')
	@include('admin.events.profile.partials.breadcrumb')
	
	<div class="span3 alpha">
		@include('admin.events.profile.partials.nav_bar')
	</div>
	<div class="span9 omega">
		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($companies as $company)
					<tr>
						<td>
							{{ $company->name }}
						</td>
						<td>
							@if($company->pivot->interview)
							@else
							@endif

							@if($company->pivot->interview)
								{!! Form::open(['url' => 'admin/events/remove-interview/'.$event->id.'/'.$company->id, 'class' => 'remove-interview-tag']) !!}
									{!! Form::submit('Löschen') !!}
								{!! Form::close() !!}
								{{-- HTML::link('admin/events/remove-interview/'.$event->id.'/'.$company->id, 'Löschen') --}}			
							@else
								{!! Form::open(['url' => 'admin/events/add-interview/'.$event->id.'/'.$company->id, 'class' => 'add-interview-tag']) !!}
									{!! Form::submit('Hinzufügen') !!}
								{!! Form::close() !!}
								{{-- HTML::link('admin/events/add-interview/'.$event->id.'/'.$company->id, 'Hinzufügen') --}}
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop
