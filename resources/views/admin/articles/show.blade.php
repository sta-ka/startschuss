@extends('layouts.admin')

@section('title', 'Alle Artikel anzeigen')

@section('content')
	<div class="span3 alpha">
		{!! HTML::link('admin/articles/new', 'Neuer Artikel', ['class' => 'btn btn-success']) !!}
	</div>
	<div class="span7">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Info</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($articles as $article)
					<tr>
						<td>{{ $article->id }}</td>
						<td>{{ $article->title }}</td>
						<td>
							@if($article->featured)
								<span class="label label-success">Featured</span>
							@endif
							@if( ! $article->active) 
								<span class="label label-warning">Deaktiv</span>
							@endif
						</td>
						<td>
							{!! HTML::imageLink('admin/articles/'.$article->id.'/edit', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							{!! HTML::imageLink('admin/articles/'.$article->id.'/delete', 'assets/img/icons/erase.png', 'Löschen', ['title' => 'Löschen']) !!}
							@if($article->active) 
								{!! HTML::imageLink('karriereratgeber/'.$article->slug, 'assets/img/icons/show.png', 'Anzeigen', ['target' => '_blank', 'title' => 'Anzeigen']) !!}
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="span2 omega">
		&nbsp;
	</div>	
@stop

