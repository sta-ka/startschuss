@extends('layouts.admin')

@section('title', 'Veranstalterprofil bearbeiten')

@section('content')
	@include('admin.companies.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.companies.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($company, ['url' => 'admin/companies/'.$company->id.'/update-profile']) !!}
			<div class="span7 alpha">
				<div class="form-group">
					{!! Form::label('profile', 'Profil')!!}
					{!! Form::textarea('profile', null, ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
				<div>
					{!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm'])!!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span2 omega">
		&nbsp;
	</div>
@stop