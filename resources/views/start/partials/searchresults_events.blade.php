@if(Input::has('stadt'))
    <div id="search-results">
        @if($events->total() > 0)
            <div class="alert alert-success">
                <h4 class="alert-heading">Erfolg!</h4>
                Ihre Suche ergab <strong>{{ $events->total() }}</strong> Treffer!
            </div>
        @else
            <div class="alert alert-danger">
                <h4 class="alert-heading">Keine Treffer!</h4>
                Ihre Suche ergab keine Treffer!
                <br><br>
                {!! HTML::linkRoute('messekalender', 'Alle Jobmessen anzeigen') !!}
            </div>
        @endif
    </div>
@endif