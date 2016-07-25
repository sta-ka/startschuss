@extends('layouts.organizer')

@section('title', 'Profil anzeigen')

@section('content')
	<div class="span8 alpha">
		@if($events->count())
			<h3>Aktuelle Veranstaltungen</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Datum</th>
						<th>Info</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($events as $event)
						<tr>
							<td>{{ $event->name }}</td>
							<td>
								@if($event->start_date !== $event->end_date)
									{{ ltrim(Date::format($event->start_date, 'day'), '0') }}. -
								@endif
								{{ Date::german($event->end_date, false) }}
							</td>
							<td>
								@if($event->visible)
									<span class="label label-success">Sichtbar</span>
								@else 
									<span class="label label-warning">N. sichtbar</span>
								@endif
							</td>
							<td>
								{!! HTML::imageLink('organizer/profile/'. $event->id .'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
								{!! HTML::imageLink('organizer/profile/new/'. $event->id , 'assets/img/icons/plus.png', 'Neue Veranstaltung', ['title' => 'Neue Veranstaltung']) !!}
								@if($event->visible)
									{!! HTML::imageLink('jobmesse/'. $event->slug, 'assets/img/icons/show.png', 'Anzeigen', ['target' => '_blank', 'title' => 'Anzeigen']) !!}
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>Ihr Konto ist mit keiner aktuellen Veranstaltung verknüpft.</p>
		@endif

		@if($past_events->count())
			<br>
			<h3>Vergangene Veranstaltungen</h3>
			<p>Vergangene Veranstaltungen können nicht mehr bearbeitet werden.</p>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Datum</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($past_events as $event)
						<tr>
							<td>{{ $event->name }}</td>
							<td>
								{{ Date::monthDate($event->start_date, $event->end_date, false) .' '. Date::format($event->end_date, 'year') }}
							</td>
							<td>
								{!! HTML::imageLink('organizer/profile/new/'. $event->id, 'assets/img/icons/plus.png', 'Neue Veranstaltung', ['title' => 'Neue Veranstaltung']) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
	</div>
	<div class="span4 omega">
		<p>Sie können mit dem {!! HTML::image('assets/img/icons/plus.png', 'Neue Veranstaltung') !!} eine Veranstaltung erstellen. Diese wird durch uns geprüft und bei erfolgreicher Prüfung freigeschaltet.</p>
		<p>Die Anzahl der von einem Veranstalter vorgeschlagenen Veranstaltungen ist auf 2 begrentzt.</p>

		@if($requested_events->count())
			<p>Von Ihnen erstellte Veranstaltungen:</p>
			<ul>
				@foreach($requested_events as $event)
					<li>
						{{ $event->name }}
						{{ '('. Date::monthDate($event->start_date, $event->end_date, false) .' '. Date::format($event->end_date, 'year') .')' }}
					</li>
				@endforeach
			</ul>
		@endif
		@if($requested_events->count() >= 2)
			<p>Momentan können Sie keine weiteren Veranstaltungen erstellen.</p>
		@endif
	</div>
@stop