<div class="article-preview">
    <h4>{!! HTML::link('karriereratgeber/'.$article->slug, Str::limit($article->title, 35)) !!}</h4>
    <div class="article__body">{!! Str::limit($article->body, 170) !!}</div>
    <div class="article__link">{!! HTML::link('karriereratgeber/'.$article->slug, 'Mehr lesen', ['class' => 'btn btn-success btn-xs']) !!}</div>
</div>