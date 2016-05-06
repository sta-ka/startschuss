@extends('layouts.organizer')

@section('title', 'Profil anzeigen')

@section('content')
	@include('organizer.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('organizer.events.profile.partials.nav_bar')
	</div>
	<div class="span6">
		Ihr Profil
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop