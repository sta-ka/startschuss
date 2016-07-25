@extends('layouts.default')

@section('title', $article->title . ' | Karriere-Ratgeber')

@section('metadata')
	<meta name='description' content='{{ $article->meta_description }}' />
	<meta name='keywords' content='{{ $article->keywords }}' />
@stop

@section('content')
	<div>
		<div class="col-md-8" id="article">
			<h1 class="heading-underlined--small">{{ $article->title }}</h1>
            <div class="article__body">{!! $article->body !!}</div>
		</div>
		<div class="col-md-4">
			<h2 class="heading-underlined--small">Beliebte Artikel</h2>

            @each('start.partials.article', $articles, 'article')

			{!! HTML::link('karriereratgeber', 'Zur Artikelübersicht', ['class' => 'btn btn-primary btn-block']) !!}
		</div>
	</div>
@stop