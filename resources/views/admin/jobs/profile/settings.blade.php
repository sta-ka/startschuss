@extends('layouts.admin')

@section('title', 'Stellenangaben bearbeiten')

@section('content')
	@include('admin.jobs.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.jobs.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($job, ['url' => 'admin/jobs/'.$job->id.'/update-settings']) !!}
			<div class="span3 alpha">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('featured', '1', null) !!} Featured
					</label><br>
				</div>
				<div class="checkbox">
					<label>
						{!! Form::checkbox('premium', '1', null) !!} Premium
					</label><br>
				</div>
			</div>
			<div class="span6 alpha">
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