@extends('layouts.admin')

@section('title', 'Artikeldaten bearbeiten')

@section('content')
	<div class="span2 alpha">
		{!! HTML::link('admin/articles', 'Zur Übersicht', ['class' => 'btn btn-primary']) !!}
	</div>
	<div class="span7">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'admin/articles/create', 'files' => true]) !!}
			<div class="span4 alpha">
				<div class="form-group">
					{!! Form::label('title', 'Titel') !!}
					{!! Form::text('title', Input::old('title'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('slug', 'URL')  !!}
					{!! Form::text('slug', Input::old('slug'), ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="checkbox">
					<label>
						{!! Form::checkbox('active', '1', Input::old('active')) !!} Aktiv
					</label><br>
				</div>
				<div class="checkbox">
					<label>
						{!! Form::checkbox('featured', '1', Input::old('featured')) !!} Featured
					</label><br>
				</div>
			</div>
			<div class="span7 alpha">
				<div class="form-group">
					{!! Form::label('body', 'Artikel') !!}
					{!! Form::textarea('body', Input::old('body'), ['class' => 'form-control input-sm', 'rows' => 20]) !!}
				</div>
				<div class="form-group">
					{!! Form::label('meta_description', 'Meta-Beschreibung') !!}
					{!! Form::textarea('meta_description', Input::old('meta_description'), ['class' => 'form-control input-sm', 'rows' => 3]) !!}
				</div>
				<div class="form-group">
					{!! Form::label('keywords', 'Keywords') !!}
					{!! Form::textarea('keywords', Input::old('keywords'), ['class' => 'form-control input-sm', 'rows' => 2]) !!}
				</div>
			</div>
			<div class="span4 alpha">
				<p id="filename"></p>
				
				<div class="form-group">
					<button class="btn btn-default btn-sm" id="browse-file" >Bild auswählen</button>
					{!! Form::file('image', ['id' => 'image']) !!}
				</div>
				<div>
					{!! Form::submit('Erstellen', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop