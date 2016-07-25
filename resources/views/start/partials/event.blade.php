<li itemscope itemtype="http://schema.org/Event">
    <table>
        <tr>
            <td style="width: 135px; height: 50px">
                @if($event->logo)
                    {!! HTML::image('uploads/logos/small/'. $event->logo) !!}
                @endif
            </td>
            <td colspan="3">
                <span itemprop="name" class="name">{!! HTML::linkRoute('messe', $event->name, [$event->slug]) !!}</span>
                <meta itemprop="description" content="Jobmesse">
                <meta itemprop="url" content="{{ URL::route('messe', [$event->slug]) }}">
            </td>
        </tr>
        <tr>
            <td class="date">
                @if($event->start_date == $event->end_date)
                    <span itemprop="startDate" content="{{ Date::format($event->start_date, 'ISO')}}">
                            {{ Date::monthDate($event->start_date) }}
                    </span>
                    <meta itemprob="endDate" content="{{ Date::format($event->end_date, 'ISO')}}">
                @else
                    <span itemprop="startDate" content="{{ Date::format($event->start_date, 'ISO')}}">
                        {{ Date::format($event->start_date, 'day').'. -' }}
                    </span>
                    <span itemprop="endDate" content="{{ Date::format($event->end_date, 'ISO')}}">
                        {{ Date::monthDate($event->end_date) }}
                    </span>
                @endif
            </td>
            <td colspan="2">
                <span itemprop="organizer">
                    <strong>Veranstalter: </strong>{!! HTML::linkRoute('veranstalter', $event->organizer->name, [$event->organizer->slug]) !!}
                </span>
            </td>
            <td style="width: 120px;" itemprop="location" itemscope itemtype="http://schema.org/Place">
                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span  itemprop="addressLocality" content="{{ $event->location }}">
                        {{ $event->location }}<br>
                        <meta itemprop="addressRegion" content="{{ $event->region->name }}">
                    </span>
                </div>
            </td>
        </tr>
    </table>
</li>

