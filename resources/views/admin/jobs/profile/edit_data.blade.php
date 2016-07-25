@extends('layouts.admin')

@section('title', 'Stellenangaben bearbeiten')

@section('content')
	@include('admin.jobs.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.jobs.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($job, ['url' => 'admin/jobs/'. $job->id .'/update-data']) !!}
			<div class="span6 alpha">
				<div class="form-group">
					{!! Form::label('title', 'Titel/Kurzinfo') !!}
					{!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('location', 'Einsatzort')  !!}
					{!! Form::text('location', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span3 omega">
				<div class="form-group">
					{!! Form::label('start_date', 'Beginn der Beschäftigung') !!}
					{!! Form::text('start_date', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span8 alpha">
				<div class="form-group">
					{!! Form::label('description', 'Stellenbeschreibung') !!}
					{!! Form::textarea('description', null, ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
				<div class="form-group">
					{!! Form::label('requirements', 'Anforderungen') !!}
					{!! Form::textarea('requirements', null, ['class' => 'form-control input-sm', 'rows' => 15]) !!}
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