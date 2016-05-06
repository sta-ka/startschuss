@extends('emails.layouts.default')

@section('content')
	<h2>Konto aktivieren</h2>

	<div>
		{!! HTML::link('konto-aktivieren/'.$activation_code, 'Konto aktivieren') !!}
	</div>
@stop