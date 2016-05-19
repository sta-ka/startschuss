@extends('emails.layouts.default')

@section('main_content')
	<h2>Neue Jobmesse</h2>

	<div>
		<p>Ansprechpartner: {{ $contact }}</p>
		<p>Name der Veranstaltung: {{ $name }}</p>
		<p>Veranstaltungsort: {{ $location }}</p>
		<p>Beginn: {{ $start_date }}</p>
		<p>Ende: {{ $end_date }}</p>
		<p>Region: {{ $region }}</p>
		<p>Veranstalter: {{ $organizer }}</p>
	</div>
@stop