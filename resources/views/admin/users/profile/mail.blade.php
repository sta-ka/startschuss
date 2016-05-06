@extends('layouts.admin')

@section('title', 'Nachricht senden')

@section('content')
	@include('admin.users.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.users.profile.partials.nav_bar')
	</div>
	<div class="span7">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'admin/users/'.$user->id.'/send-mail']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('recipient', 'Empfänger')!!}
					{!! Form::text('recipient', $user->email, ['class' => 'form-control input-sm', 'disabled' => 'disabled']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('subject', 'Betreff')!!}
					{!! Form::text('subject', Input::old('subject'), ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span7 alpha">
				<div class="form-group">
					{!! Form::label('body', 'Nachricht')!!}
					{!! Form::textarea('body', Input::old('body'), ['class' => 'form-control input-sm', 'rows' => 14]) !!}
				</div>
				<div>
					{!! Form::submit('Senden', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close()!!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop