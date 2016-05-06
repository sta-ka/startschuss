@extends('layouts.admin')

@section('title', 'Veranstalterlogo bearbeiten')

@section('content')
	@include('admin.organizers.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.organizers.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		@if($organizer->logo)
			{!! HTML::image('uploads/logos/medium/'.$organizer->logo, $organizer->name) !!}
			<br><br>
			{!! HTML::link('admin/organizers/'.$organizer->id.'/delete-logo', 'Logo löschen', ['class' => 'btn btn-danger btn-sm']) !!}
		@else
			<p id="filename"></p>
			
			{!! Form::open(['url' => 'admin/organizers/'.$organizer->id.'/edit-logo', 'files' => true]) !!}

			<div class="form-group">
				<button class="btn btn-default btn-sm" id="browse-file" >Logo auswählen</button>
				{!! Form::file('logo', ['id' => 'logo']) !!}
			</div>

			<div>
				{!! Form::submit('Hochladen', ['class' => 'btn btn-primary btn-sm']) !!}
			</div>

			{!! Form::close() !!}
		@endif
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop