@extends('layouts.admin')

@section('title', 'Metadaten bearbeiten')

@section('content')
	@include('admin.events.profile.partials.breadcrumb')
	
	<div class="span3 alpha">
		@include('admin.events.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($event, ['url' => 'admin/events/'.$event->id.'/update-seo-data']) !!}
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('slug', 'URL')!!}
					{!! Form::text('slug', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group">
					{!! Form::label('meta_description', 'Beschreibung') !!}
					{!! Form::textarea('meta_description', null, ['class' => 'form-control input-sm', 'rows' => 3]) !!}
				</div>
				<div class="form-group">
					{!! Form::label('keywords', 'Keywords') !!}
					{!! Form::textarea('keywords', null, ['class' => 'form-control input-sm', 'rows' => 2]) !!}
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