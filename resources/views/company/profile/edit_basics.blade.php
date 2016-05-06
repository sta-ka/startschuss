@extends('layouts.company')

@section('title', 'Veranstaltungsdaten bearbeiten')

@section('content')
	@include('company.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('company.profile.partials.nav_bar')
	</div>
	<div class="span9 omega">
		@include('partials/validation_errors')

		{!! Form::model($company, ['url' => 'company/profile/'.$company->id.'/update-basics']) !!}
			<div class="span8 alpha">
				<div class="form-group">
					{!! Form::label('profile', 'Profil') !!}
					{!! Form::textarea('profile', null, ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
				<div>
					{!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
@stop