@extends('layouts.default')

@section('title', 'Seite nicht gefunden')

@section('content')
	<?php 
		if($user = Sentry::getUser()) {
            $groupname = $user->getGroups()->first()->name;

            if(in_array($groupname, ['admin', 'organizer', 'company', 'applicant'])) {
                $link = $groupname;
            } else {
                $link = '';
            }
		}
	?>
	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span7">
		<h3>Seite nicht gefunden</h3>

		<p>Die gesuchte Seite konnte nicht gefunden werden. Überprüfen Sie die URL oder versuchen Sie es erneut.</p>

		@if(isset($link))
			{!! HTML::link($link . '/dashboard', 'Zu meinem Konto', ['class' => 'green']) !!}
		@else
			{!! HTML::link('home', 'Zurück zur Startseite', ['class' => 'green']) !!}
		@endif

		<br><br>

		<p>Sollte das Problem bestehen bleiben, können Sie sich gerne an uns wenden.</p>
		{!! HTML::link('kontakt', 'Kontakt aufnehmen', ['class' => 'green']) !!}
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop