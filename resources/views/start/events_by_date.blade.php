@extends('layouts.default')

@section('title', 'Jobmessen im ' . Str::ucfirst($month) .' '. Request::segment(2) )

@section('metadata')
    <meta name='description' content='Karriere- und Jobmessen im {{ Str::ucfirst($month) .' '. Request::segment(2) }}' />
@stop

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-9">
        <div id="events">
            <h1 class="heading-underlined">Karriere- und Jobmessen im {{ Str::ucfirst($month) .' '. Request::segment(2) }}</h1>
            @if(count($events))
                <ul class="eventslist list-unstyled">
                    @each('start.partials.event', $events, 'event')
                </ul>
                <div class="pull-right">
                    <p>{!! HTML::linkRoute('messekalender', 'Alle Messen', [], ['class' => 'green']) !!}</p>
                </div>
            @else
                <p>Keine Veranstaltungen gefunden.</p>
            @endif

        </div>

        @include('start.partials.missing_event')
    </div>

    <div class="col-xs-12 col-sm-12 col-md-3">

        @include('start.partials.searchbox_events')
        @include('start.partials.months')

    </div>

@stop