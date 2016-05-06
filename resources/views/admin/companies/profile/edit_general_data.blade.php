@extends('layouts.admin')

@section('title', 'Unternehmensdaten bearbeiten')

@section('content')
	@include('admin.companies.profile.partials.breadcrumb')
	
	<div class="span3 alpha">
		@include('admin.companies.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@include('partials/validation_errors')

		{!! Form::model($company, ['url' => 'admin/companies/'.$company->id.'/update-general-data']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('name', 'Name (Kurzform)')!!}
					{!! Form::text('name', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('full_name', 'Name')!!}
					{!! Form::text('full_name', null, ['class' => 'form-control input-sm']) !!}
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