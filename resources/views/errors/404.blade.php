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
	<div class="col-xs-7 col-sm-6 col-md-6 col-sm-offset-1 col-md-offset-1">
		<h3>Seite nicht gefunden</h3>

		<p>Die gesuchte Seite konnte nicht gefunden werden. Überprüfen Sie die URL oder versuchen Sie es erneut.</p>

		@if(isset($link))
			{!! HTML::link($link . '/dashboard', 'Zu meinem Konto', ['class' => 'green']) !!}
		@else
			{!! HTML::link('', 'Zurück zur Startseite', ['class' => 'green']) !!}
		@endif

		<br><br>

		<p>Sollte das Problem bestehen bleiben, können Sie sich gerne an uns wenden.</p>
		{!! HTML::link('kontakt', 'Kontakt aufnehmen', ['class' => 'green']) !!}
	</div>
@stop