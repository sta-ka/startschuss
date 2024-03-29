@extends('layouts.default')

@section('title', 'Der Jobmesse- und Karriereratgeber')

@section('metadata')
	<meta name='description' content='startschuss-karriere.de bietet einen Karriereratgeber und informiert über Jobmessen, Karrieremöglichkeiten und den Berufseinstieg.' />
	<meta name='keywords' content='karriereratgeber, jobmessen, berufeinstieg, firmenmesse' />
@stop

@section('content')
    <div class="col-xs-12 col-sm-8 col-md-8">
        <p>Der Karriere- und Jobmesseratgeber bereitet Sie auf eine erfolgreiche Jobmesse und einen gelungenen Berufseinstieg vor. Er beantwortet Fragen zur Vorbereitung auf die Jobmesse, zum Messebesuch selbst und der Nachbereitung.</p>

    </div>
    <div id="article-featured">
        <?php $count = 0; ?>
        @foreach($featured_articles as $article)
            <div class="article ol-xs-6 col-sm-6 col-md-6" >
                <h2>{!! HTML::link('karriereratgeber/'. $article->slug, $article->title) !!}</h2>
                <div class="article__body">{!! Str::limit($article->body , 420)  !!}</div>
                <div class="article__link">{!! HTML::link('karriereratgeber/'. $article->slug, 'Mehr lesen', ['class' => 'btn btn-success btn-xs']) !!}</div>
            </div>
        @endforeach
    </div>

	@if($articles->count())
		<div id="more-articles__header" class="col-xs-12 col-sm-12 col-md-12">
			<h1>Weitere Artikel</h1>
		</div>

		<div>
			@foreach(array_chunk($articles->all(), 3) as $row)
				<div id="more-articles">
				@foreach($row as $article)
					<div class="article ol-xs-6 col-sm-6 col-md-4">
                        <h2 title="{{ $article->title }}">{!! HTML::link('karriereratgeber/'. $article->slug, Str::limit($article->title, 50)) !!}</h2>
                        <div class="article__body">{!! Str::limit($article->body , 220)  !!}</div>
                        <div class="article__link">{!! HTML::link('karriereratgeber/'. $article->slug, 'Mehr lesen', ['class' => 'btn btn-success btn-xs']) !!}</div>
					</div>
				@endforeach
				</div>
			@endforeach
		</div>
	@endif
@stop