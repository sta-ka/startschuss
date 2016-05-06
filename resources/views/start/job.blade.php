@extends('layouts.default')

@section('title', 'Jobs')

@section('metadata')
	<meta name='description' content="{{ $job->meta_description }}" />
	<meta name='keywords' content='karriere, stellenangebote, praktika' />
@stop

@section('content')
	<div>
		<h1>{{ $job->title }}</h1>
		<small>{{ $job->company->full_name }}</small>

		<p>{{ $job->location }}</p>
		<p>{{ $job->start_date }}</p>

		<p>{{ $job->description }}</p>
		<p>{{ $job->requirement }}</p>

	</div>
@stop