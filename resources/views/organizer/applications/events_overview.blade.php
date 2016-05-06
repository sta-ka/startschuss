@extends('layouts.organizer')

@section('title', 'Profil anzeigen')

@section('content')
	<div class="span8 alpha">
		@if($events->count())
			<h3>Bewerbungen für meine Veranstaltungen</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Zahl der Bewerbungen</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($events as $event)
						<tr>
							<td>{{ $event->name }}</td>
							<td>{{ $event->applications()->count() }}</td>
							<td>
								{!! HTML::imageLink('organizer/applications/event/'.$event->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>Momentan werden keine Veranstaltungen angezeigt.</p>
		@endif
	</div>
	<div class="span4 omega">
		&nbsp;
	</div>
@stop