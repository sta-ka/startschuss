@extends('layouts.admin')

@section('title', 'Programm bearbeiten')

@section('content')
	@include('admin.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.events.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($event, ['url' => 'admin/events/'. $event->id .'/update-program']) !!}
			<div class="span8 alpha">
				<div class="form-group">
					{!! Form::label('program', 'Programm') !!}
					{!! Form::textarea('program', null, ['class' => 'form-control input-sm', 'rows' => 20]) !!}
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