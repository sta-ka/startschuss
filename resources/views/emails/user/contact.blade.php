@extends('emails.layouts.default')

@section('main_content')
	<h2>Nachricht über das Kontaktformular</h2>

	<div>
		<p>{{ $name }}</p>
		<p>{{ $email }}</p>
		<p>{{ $body }}</p>
	</div>
@stop