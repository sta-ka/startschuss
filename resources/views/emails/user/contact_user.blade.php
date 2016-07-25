@extends('emails.layouts.default')

@section('main_content')

    @if(isset($subject))
        <h2>{{ $subject }}</h2>
        <br>
    @endif

	<div style="color:#7f8c90">
		<p>{!!  $body !!}</p>
	</div>
@stop