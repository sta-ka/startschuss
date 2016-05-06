@extends('layouts.company')

@section('title', 'Profil anzeigen')

@section('content')
	@include('company.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('company.profile.partials.nav_bar')
	</div>
	<div class="span6">
		Ihr Profil
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop