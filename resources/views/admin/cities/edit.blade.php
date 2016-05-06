@extends('layouts.admin')

@section('title', 'Daten der Stadt bearbeiten')

@section('content')
	<div class="span2 alpha">
		{!! HTML::link('admin/cities', 'Zur Übersicht', ['class' => 'btn btn-primary']) !!}
	</div>
	<div class="span7">
		@include('partials/validation_errors')

		{!! Form::model($city, ['url' => 'admin/cities/'.$city->id.'/update']) !!}
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('name', 'Name') !!}
					{!! Form::text('name', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('slug', 'URL')  !!}
					{!! Form::text('slug', null, ['class' => 'form-control input-sm']) !!}
				</div>
			</div>
			<div class="span7 alpha">
				<div class="form-group">
					{!! Form::label('description', 'Beschreibung') !!}
					{!! Form::textarea('description', null, ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
				<div class="form-group">
					{!! Form::label('meta_description', 'Meta-Beschreibung') !!}
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