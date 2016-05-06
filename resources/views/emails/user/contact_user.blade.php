@extends('emails.layouts.default')

@section('content')
	<h2>{{ $subject }}</h2>

	<div>
		<p>Hallo {{ $username }}!</p>
		<p>{{ $body }}</p>
	</div>
@stop