<div id="events-archive">
    <h3>{{HTML::linkRoute('messearchiv', 'Alle Messen in ' . date('Y'), [date('Y'), Str::lower(Date::getMonthNames()[date('n')])]) }}</h3>
    <p>{{HTML::linkRoute('messearchiv', 'Überblick über alle Jobmessen geordnet nach Monat.', [date('Y'), Str::lower(Date::getMonthNames()[date('n')])]) }}</p>
</div>