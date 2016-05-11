@extends('layouts.default')

@section('title', 'Jobmessen ' . $region->prefix . ' ' . $region->name)

@section('metadata')
    <meta name='description' content='{{ $region->meta_description }}' />
    <meta name='keywords' content='{{ $region->keywords }}' />
    {!! renderPaginationMetaData($events) !!}
@stop

@section('content')
    <div class="span9 alpha">
        <div id="region-description">{!! $region->description !!}</div>
        <br>
        <div id="events">

            <h1 class="heading-underlined">Karriere- und Jobmessen {{ $region->prefix .' '. $region->name }}</h1>
            @if($events->total() > 0)
                <ul class="eventslist list-unstyled">
                    @each('start.partials.event', $events, 'event')
                </ul>
                @if($events->hasMorePages() == false)
                    <div class="pull-right">
                        <p>{!! HTML::linkRoute('messekalender', 'Alle Messen', [], ['class' => 'green']) !!}</p>
                    </div>
                @endif

            @else
                <p>Keine Veranstaltungen gefunden.</p>
            @endif

            {!! $events->setPath('')->render(new \App\Services\Pagination\CustomPresenter($events)) !!}
        </div>

        @include('start.partials.missing_event')
    </div>

    <div class="span3 omega">

        @include('start.partials.searchbox_events')
        @include('start.partials.regions')
        @include('start.partials.events_archive')

    </div>

@stop