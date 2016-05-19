@extends('emails.layouts.default')

@section('main_content')
	<h2>{{ $subject }}</h2>
    <br>

	<div style="color:#7f8c90">
		<p>{!! $body !!}</p>
	</div>
@stop