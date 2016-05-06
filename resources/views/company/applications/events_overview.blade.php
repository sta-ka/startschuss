@extends('layouts.company')

@section('title', 'Profil anzeigen')

@section('content')
	<div class="span7 alpha">
		@if($events->count())
			<h3>Bewerbungen für meine Veranstaltungen</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($events as $event)
						<tr>
							<td>{{ $event->name }}</td>
							<td style="width:80px">
								{!! HTML::imageLink('company/applications/event/'.$event->id, 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>Momentan werden keine Veranstaltungen angezeigt.</p>
		@endif
	</div>
	<div class="span5 omega">
		<p>Hier sehen Sie alle Veranstaltungen bei denen Sie Einzelgespräche anbieten.</p>
		<p>Klicken sie auf eine einzelne Veranstaltung um sich die Bewerbungen anzeigen zu lassen.</p>
	</div>
@stop