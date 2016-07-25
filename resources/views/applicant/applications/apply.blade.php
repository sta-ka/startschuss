@extends('layouts.applicant')

@section('title', 'Neue Bewerbung')

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('applicant/applications/show', 'Übersicht') !!}</li>
			<li class="active">Neue Bewerbung - Übersicht</li>
		</ol>
	</div>
	<div class="span1 alpha">
		&nbsp;
	</div>	
	<div class="span10">
		@if(count($events))
			<h3>Messen</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Datum</th>
						<th>Ort</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($events as $event)
						<tr>
							<td>{{ $event->name }}</td>
							<td>{{ Date::monthDate($event->start_date, $event->end_date, false) }}</td>
							<td>{{ $event->location }}</td>
							<td>{!! HTML::imageLink('applicant/applications/event/'. $event->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>Eine Bewerbung für Einzelgespräche ist zur Zeit nicht möglich.</p>
		@endif
	</div>
	<div class="span1 omega">
		&nbsp;
	</div>
@stop