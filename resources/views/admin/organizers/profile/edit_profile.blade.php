@extends('layouts.admin')

@section('title', 'Veranstalterprofil bearbeiten')

@section('content')
	@include('admin.organizers.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.organizers.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($organizer, ['url' => 'admin/organizers/'.$organizer->id.'/update-profile']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('address1', 'Adresse')!!}
					{!! Form::text('address1', null, ['class' => 'form-control input-sm']) !!}
					{!! Form::text('address2', null, ['class' => 'form-control input-sm']) !!}
					{!! Form::text('address3', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span7 alpha">
				<div class="form-group">
					{!! Form::label('profile', 'Profil')!!}
					{!! Form::textarea('profile', null, ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
				<div>
					{!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span2 omega">
		&nbsp;
	</div>
@stop