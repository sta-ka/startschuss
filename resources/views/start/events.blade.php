@extends('layouts.default')

@section('title', 'Jobmessekalender')

@section('metadata')
	<meta name='description' content='startschuss-karriere.de bietet in einem Jobmessekalender einen detaillierten Überblick über zukünftige Karriere- und Jobmessen.' />
	<meta name='keywords' content='karriere, jobmessekalender, firmenkontaktgespräch' />
    {!! renderPaginationMetaData($events) !!}
@stop

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-9">
        @include('start.partials.searchresults_events')

        @if($events->total() > 0)
            <div id="events">
                <h1 class="heading-underlined">Karriere- und Jobmessen</h1>

				<ul class="eventslist list-unstyled">
				    @each('start.partials.event', $events, 'event')
				</ul>

                @if($events->lastPage() <= 1)
					<div class="pull-right">
						<p>{!! HTML::linkRoute('messekalender', 'Alle Messen', [], ['class' => 'green']) !!}</p>
					</div>
				@endif

				{!! $events->setPath('')->appends(Request::except('page'))->render(new \App\Services\Pagination\CustomPresenter($events)) !!}
            </div>
        @endif

        @include('start.partials.missing_event')

	</div>

	<div class="col-md-3">
		
		@include('start.partials.searchbox_events')
		@include('start.partials.regions')
		@include('start.partials.events_archive')

	</div>
@stop