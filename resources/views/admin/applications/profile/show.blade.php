@extends('layouts.admin')

@section('title', 'Bewerbung anzeigen')

@section('content')
	@include('admin.applications.profile.partials.breadcrumb')

	<div class="span1 alpha">
		&nbsp;
	</div>
	<div class="span8">
		<h3>Bewerbung</h3>
		<p><strong>Bewerber:</strong> {{ $application->user->username }}</p>
		<p><strong>Veranstaltung:</strong> {{ $application->event->name }}</p>
		<p><strong>Unternehmene:</strong> {{ $application->company->name }}</p>
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop