@extends('emails.layouts.default')

@section('content')
	<h2>Neues Passwort vergeben</h2>

	<div>
		{!! HTML::link('neues-passwort/'.$reset_code, 'Passwort vergeben') !!}
	</div>
@stop