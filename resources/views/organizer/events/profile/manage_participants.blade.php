@extends('layouts.organizer')

@section('title', 'Teilnehmer verwalten')

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
				"fnDrawCallback": function() {
					$('#datatable_filter input, #datatable_length select').addClass('form-element input-sm');
				}
			});
		});	
	</script>
@stop

@section('content')
	@include('organizer.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('organizer.events.profile.partials.nav_bar')
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
							@if($company->participants->contains($event->id))
								-
							@else
								{!! Form::open(['url' => 'organizer/profile/add-company/'.$event->id.'/'.$company->id, 'class' => 'add-participant']) !!}
									{!! Form::submit('Als Teilnehmer hinzufügen') !!}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop
