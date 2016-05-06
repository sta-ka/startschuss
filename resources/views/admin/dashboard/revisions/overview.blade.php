@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
	<div class="span1 alpha">
		&nbsp;
	</div>
	<div class="span6">
	<h3>Änderungen</h3>
		<table class="table">
			<tr><td>{!! HTML::link('admin/dashboard/user-revisions', 'Änderungen Nutzer') !!}</td></tr>
			<tr><td>{!! HTML::link('admin/dashboard/event-revisions', 'Änderungen Veranstaltungen') !!}</td></tr>
			<tr><td>{!! HTML::link('admin/dashboard/company-revisions', 'Änderungen Unternehmen') !!}</td></tr>
			<tr><td>{!! HTML::link('admin/dashboard/organizer-revisions', 'Änderungen Veranstalter') !!}</td></tr>
		</table>
	</div>
	<div class="span5 omega">
		&nbsp;
	</div>
@stop