@extends('layouts.admin')

@section('title', 'Artikeldaten bearbeiten')

@section('content')
	<div class="span2 alpha">
		{!! HTML::link('admin/articles', 'Zur Übersicht', ['class' => 'btn btn-primary']) !!}
	</div>
	<div class="span7">
		@include('partials/validation_errors')

		{!! Form::model($article, ['url' => 'admin/articles/'.$article->id.'/update', 'files' => true]) !!}
			<div class="span5 alpha">
				<div class="form-group">
					{!! Form::label('title', 'Titel') !!}
					{!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('slug', 'URL')  !!}
					{!! Form::text('slug', null, ['class' => 'form-control input-sm']) !!}
				</div>
				<div class="checkbox">
					<label>
						{!! Form::checkbox('active', '1', null) !!} Aktiv
					</label><br>
				</div>
				<div class="checkbox">
					<label>
						{!! Form::checkbox('featured', '1', null) !!} Featured
					</label><br>
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group">
					@if($article->image)
						{!! HTML::image('uploads/images/small/'.$article->image, $article->title) !!}
						<br>
						<br>
						<div>
							{!! HTML::link('admin/articles/'.$article->id.'/delete-image', 'Bild löschen', ['class' => 'btn btn-danger btn-sm']) !!}
						</div>
					@else
						<p id="filename"></p>
						
						<div class="form-group">
							<button class="btn btn-default btn-sm" id="browse-file" >Bild auswählen</button>
							{!! Form::file('image', ['id' => 'image']) !!}
						</div>
					@endif
				</div>
			</div>
			<div class="span7 alpha">
				<div class="form-group">
					{!! Form::label('body', 'Artikel') !!}
					{!! Form::textarea('body', null, ['class' => 'form-control input-sm', 'rows' => 20]) !!}
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