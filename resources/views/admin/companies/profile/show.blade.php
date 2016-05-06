@extends('layouts.admin')

@section('title', 'Unternehmen anzeigen')

@section('content')
	@include('admin.companies.profile.partials.breadcrumb')
	
	<div class="span3 alpha">
		@include('admin.companies.profile.partials.nav_bar')
	</div>
	<div class="span6">
		<div class="info-box span6 alpha">
			<p>Diese Veranstaltung ist mit folgenden Nutzerkonten verknüfpt:</p>
			@if($users->count())
				<br>
				@foreach($users as $user)
					<div class="row">
						<div class="col-xs-12">
							Nutzer: <strong>{!! HTML::link('admin/users/'.$user->id.'/show', $user->username) !!}</strong>
							{!! HTML::link('admin/companies/delete-linkage/'.$company->id.'/'.$user->id, 'Verknüpfung löschen', ['class' => 'btn btn-danger btn-sm']) !!}
						</div>
					</div>
				@endforeach
			@else
				<p><i>Keine Verküpfungen vorhanden.</i></p>
			@endif

			@if($users_list)
				<br>
				{!! Form::open(['url' => 'admin/companies/'.$company->id.'/add-linkage']) !!}
				<div class="row">
					<div class="col-xs-8">
						{!! Form::select('user_id', $users_list, null, ['class' => 'form-control input-sm']) !!}
					</div>
					{!! Form::submit('Mit Konto verknüpfen', ['class' => 'btn btn-success btn-sm']) !!}
				</div>
				{!! Form::close() !!}
			@endif

			@if($company->deleted_at)
				<p>Diese Unternehmen ist <strong>gelöscht</strong>.</p>
				{!! HTML::link('admin/companies/restore/'.$company->id, 'Wiederherstellen', ['class' => 'btn btn-success btn-sm']) !!}
				{!! HTML::link('admin/companies/delete/'.$company->id, 'Endgültig löschen', ['class' => 'btn btn-danger btn-sm']) !!}
			@endif
		</div>
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop