@extends('layouts.company')

@section('title', 'Alle Stellenangebote anzeigen')

@section('content')
	@include('company.jobs.partials.breadcrumb')

	<div class="span2 alpha">
		@include('company.jobs.partials.nav_bar')
	</div>
	<div class="span8">
		<ul>
			<li>{!! HTML::link('company/jobs/'.$job->id.'/show', $job->title) !!}</li>
		</ul>
	</div>
	<div class="span2 omega">
		&nbsp;
	</div>
@stop