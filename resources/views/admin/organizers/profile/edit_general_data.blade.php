@extends('layouts.admin')

@section('title', 'Veranstalterdaten bearbeiten')

@section('content')
	@include('admin.organizers.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.organizers.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($organizer, ['url' => 'admin/organizers/'.$organizer->id.'/update-general-data']) !!}
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('name', 'Name')!!}
					{!! Form::text('name', null, ['class' => 'form-control input-sm']) !!}
				</div>
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