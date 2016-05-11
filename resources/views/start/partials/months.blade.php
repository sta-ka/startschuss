<div id="regions">
    <h3 class="heading-underlined--small">Messen im Jahr {{ Request::segment(2) }}</h3>
    <ul id="monthslist" class="list-unstyled">
        <?php $months = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'] ;?>
        @foreach($months as $m)
                @if($month == Str::lower($m))
                    <li><strong>{{ $m }}</strong></li>
                @else
                    <li>{!! HTML::linkRoute('messearchiv', $m, [Request::segment(2), Str::lower($m)]) !!}</li>
                @endif
        @endforeach
    </ul>
</div>

