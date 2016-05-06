@extends('layouts.admin')

@section('title', 'Alle Unternehmens anzeigen')

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
			{!! HTML::link('admin/companies/new', 'Neues Unternehmen', ['class' => 'btn btn-success']) !!}
			<br>
			<br>
		</div>

		<table id="datatable" class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>User</th>
					<th>Name</th>
					<th>Info</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($companies as $company)
					<tr>
						<td>{{ $company->id }}</td>
						<td>
							@if($company->users->count())
								{{ $company->users->count() }}
							@else
								-
							@endif
						</td>
						<td>{{ $company->name }}</td>
						<td>
							@if($company->featured)
								<span class="label label-success">Featured</span>
							@endif
							@if($company->premium)
								<span class="label label-success">Premium</span>
							@endif
						</td>
						<td>
							{!! HTML::imageLink('admin/companies/'.$company->id.'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							@if( ! $company->deleted_at)
								{!! HTML::imageLink('admin/companies/'.$company->id.'/delete', 'assets/img/icons/erase.png', 'Löschen', ['title' => 'Löschen']) !!}
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

