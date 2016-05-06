@extends('layouts.admin')

@section('title', 'Nutzer bearbeiten')

@section('content')
	@include('admin.users.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.users.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'admin/users/'.$user->id.'/update-user']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('username', 'Login')!!}
					{!! Form::text('username', Input::old('username', $user->username), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('password', 'E-Mail')!!}
					{!! Form::text('email', Input::old('email', $user->email), ['class' => 'form-control input-sm']) !!}
				</div>
				<div>
					{!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop