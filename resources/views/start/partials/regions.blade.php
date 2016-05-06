<div id="regions">
    <h3 class="heading-underlined--small">Messen in Ihrer Region</h3>
    <ul class="list-unstyled">
        @foreach($regions as $key => $region)

            @if($key == 16)
                <li>&nbsp;</li>
            @endif

            @if(urldecode(Request::segment(2)) == urldecode($region->slug))
                <li><strong>{{ $region->name }}</strong></li>
            @else
                <li>{!! HTML::linkRoute('messen', $region->name, [$region->slug]) !!}</li>
            @endif
        @endforeach
    </ul>
</div>