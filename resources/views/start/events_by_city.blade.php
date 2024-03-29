@extends('layouts.default')

@section('title', 'Jobmessen in '. $city->name)

@section('metadata')
	<meta name='description' content='{{ $city->meta_description }}' />
	<meta name='keywords' content='{{ $city->keywords }}' />
    {!! renderPaginationMetaData($events) !!}
@stop

@section('content')
	<div class="col-xs-12 col-sm-12 col-md-9">
		<div id="city-description">{!!  $city->description !!}</div>
		<br>
		<div id="events">
			<h1 class="heading-underlined">Karriere- und Jobmessen in {{ $city->name }}</h1>
			@if($events->total() > 0)
				<ul class="eventslist list-unstyled">
                    @each('start.partials.event', $events, 'event')
				</ul>
				@if($events->hasMorePages() == false)
					<div class="pull-right">
						<p>{!! HTML::link('jobmessen/'. $events->first()->region->slug , 'Weitere Messen in '. $events->first()->region->name, ['class' => 'green']) !!}</p>
					</div>
				@endif
			@else
				<p>Keine Veranstaltungen gefunden.</p>
			@endif

			{!! $events->setPath('')->render(new \App\Services\Pagination\CustomPresenter($events)) !!}
		</div>


		@include('start.partials.missing_event')
	</div>

	<div class="col-xs-12 col-sm-12 col-md-3">

		@include('start.partials.searchbox_events')
		@include('start.partials.regions')
        @include('start.partials.events_archive')

	</div>

@stop