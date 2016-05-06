@extends('layouts.applicant')

@section('title', 'Dashboard')

@section('content')

        <div id="dashboard">

            <div class="span6 alpha prefix_1">
                <h3>Meine Bewerbungen</h3>
            </div>
            <div class="span6 omega suffix_1">

                <div id="events">

                    <h3>Jobmessen in meiner Region</h3>
                    @if(count($events) > 0)
                        <ul class="list-group">
                            @foreach($events as $event)
                                <li class="list-group-item">
                                    <table>
                                        <tr>
                                            <td class="date" style="width: 100px;">
                                                @if($event->start_date == $event->end_date)
                                                    {{ Date::monthDate($event->start_date, $event->end_date, false) }}
                                                @else
                                                    {{ Date::format($event->start_date, 'day').'. -' }}
                                                    {{ Date::monthDate($event->end_date, false, false) }}
                                                @endif
                                            </td>
                                            <td>
                                                <span class="name">{!! HTML::linkRoute('messe', $event->name, [$event->slug]) !!}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div>
                                                    {{ $event->location }}<br>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                            @endforeach
                        </ul>

                    @else
                        <p>Keine Veranstaltungen gefunden.</p>
                    @endif
                </div>
            </div>
        </div>
@stop