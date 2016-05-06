@extends('layouts.default')

<?php $title = Request::segment(2) != '' ? Str::upper(Request::segment(2)) : 'Übersicht' ;?>

@section('title', 'Veranstalterdatenbank - ' . $title)

@section('metadata')
	<meta name='description' content='Die Veranstalterdatenbank von startschuss-karriere.de enthält alle Veranstalter von Karriere- und Jobmessen mit Kontaktdaten und Messeterminen.' />
	<meta name='keywords' content='messeveranstalter, jobmessen' />
    @if(isset($title))
        <link href="{{ URL::route('veranstalterdatenbank')  }}" rel="canonical" />
    @endif
    {!! renderPaginationMetaData($organizers) !!}
@stop

@section('content')
	<div class="span8 alpha">
		<div id="letters">
			<ul class="list-unstyled">
				<li>
					@if(Request::segment(2) == '')
						<strong>Alle</strong>
					@else
						{!! HTML::linkRoute('veranstalterdatenbank', 'Alle') !!}
					@endif
				</li>
			    @foreach(str_split('abcdefghijklmnopqrstuvwxyz') as $letter)
				<li>
					@if(Request::segment(2) == $letter)
						<strong>{{ Str::upper($letter) }}</strong>
					@else
						{!! HTML::linkRoute('veranstalterdatenbank', Str::upper($letter), [$letter], ['rel' => 'nofollow']) !!}
					@endif
				</li>
			    @endforeach
			</ul>
		</div>
		<br>
		<div id="organization-list">
            <ul class="list-unstyled">
                @if(count($organizers) > 0)
				    @each('start.partials.organizer', $organizers, 'organizer')
			    @else
					<li>Keinen Veranstalter gefunden.</li>
			    @endif
            </ul>
		</div>

		{!! $organizers->setPath('')->render(new \App\Services\Pagination\CustomPresenter($organizers)) !!}
			
	</div>

	<div class="span4 omega">
		<h3 class="heading-underlined--small">Jobmesse eintragen</h3>
		<p>
			Sind Sie Veranstalter einer Karrieremesse und möchten sich auf startschuss-karriere.de präsentieren?<br />
			Tragen Sie hier ihre Jobmesse ein.
		</p>
		<p>
			{!! HTML::link('jobmesse-eintragen', 'Jobmesse eintragen', ['class' => 'green']) !!}
		</p>
	</div>
@stop