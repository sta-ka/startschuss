@extends('layouts.default')

@section('title', 'Das Karriereportal')

@section('metadata')
	<meta name='description' content='startschuss-karriere.de bietet einen detaillierten Überblick über Karriere- und Jobmessen in Deutschland, Österreich und der Schweiz.' />
	<meta name='keywords' content='karriere, jobmesse, karrieremesse, firmenkontaktgespräch, firmenmesse' />
@stop

@section('content')
	<div class="span9 alpha">
		<div id="events">
			<h1 class="heading-underlined">Karriere- und Jobmessen</h1>
			<ul class="eventslist list-unstyled">
			@if($events)
				@each('start.partials.event', $events, 'event')
			@else
				<li>Keine Veranstaltungen gefunden.</li>
			@endif
			</ul>
			<div class="pull-right">
				<p>{!! HTML::linkRoute('messekalender', 'Alle Messen', [], ['class' => 'green']) !!}</p>
			</div>
		</div>
	</div>

	<div class="span3 omega">
        @include('start.partials.searchbox_events')
        <div id="organizers">

            <h2 class="heading-underlined--small">Veranstalter</h2>
			<ul class="list-unstyled">
				@foreach ($organizers as $organizer)
				<li>
					<div class="image">
						@if($organizer->logo)
							{!! HTML::imageLink('veranstalter/'.$organizer->slug, 'uploads/logos/medium/'.$organizer->logo, $organizer->name) !!}
						@else
							{!! HTML::linkRoute('veranstalter', $organizer->name, [$organizer->slug]) !!}
						@endif
					</div>
				</li>
				@endforeach
			</ul>
			<p>{!! HTML::linkRoute('veranstalterdatenbank', 'Alle Veranstalter', [], ['class' => 'green']) !!}</p>
		</div>

		<div>
			<h2 class="heading-underlined--small">Neueste Artikel</h2>
            @each('start.partials.article', $articles, 'article')

			{!! HTML::link('karriereratgeber', 'Zum Karriereratgeber', ['class' => 'btn btn-primary btn-block']) !!}
		</div>
	</div>	
@stop