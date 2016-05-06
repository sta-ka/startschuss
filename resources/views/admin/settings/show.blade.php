@extends('layouts.admin')

@section('title', 'Übersicht')

@section('content')
	<div class="span3 alpha">
		@include('admin.settings.nav_bar')
	</div>
	<div class="span6">
		<h3>Ihre aktuellen Daten</h3>
		<strong>Login/Nutzername:</strong>
		<p>{{ $user->username }}</p>

		<strong>E-Mail:</strong>
		<p>{{ $user->email }}</p>
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop