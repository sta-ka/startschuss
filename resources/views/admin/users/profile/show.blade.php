@extends('layouts.admin')

@section('title', 'Nutzer anzeigen')

@section('content')
	@include('admin.users.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.users.profile.partials.nav_bar')
	</div>
	<div class="span9 omega">
		<div class="span6 alpha">
			<div class="info-box span6 alpha">

				@if($user->deleted_at)
					<p>Nutzer ist <strong>gelöscht</strong>.</p>
					{!! HTML::link('admin/users/'. $user->id .'/restore', 'Wiederherstellen', ['class' => 'btn btn-success btn-sm']) !!}
					{!! HTML::link('admin/users/'. $user->id .'/delete', 'Endgültig löschen', ['class' => 'btn btn-danger btn-sm']) !!}
					<br><br>
				@endif

				@if($user->throttle)
					@if($user->throttle->banned)
						<p>Der Nutzer ist <strong>gesperrt</strong>.</p>
						{!! HTML::link('admin/users/'. $user->id .'/change-status', 'Sperrung aufheben', ['class' => 'btn btn-success btn-sm']) !!}
					@elseif($user->throttle->suspended)
						<p>Der Nutzer ist <strong>vorübergehend gesperrt</strong>.</p>
						{!! HTML::link('admin/users/'. $user->id .'/unsuspend', 'Sperrung aufheben', ['class' => 'btn btn-success btn-sm']) !!}
					@else
						@if( ! $user->activated)
							<p>Das Nutzerkonto wurde noch <strong>nicht aktiviert</strong>.</p>
							{!! HTML::link('admin/users/'. $user->id .'/send-activation-code', 'Aktivierungscode senden', ['class' => 'btn btn-warning btn-sm']) !!}
							{!! HTML::link('admin/users/'. $user->id .'/activate-user', 'Nutzer manuell aktivieren', ['class' => 'btn btn-success btn-sm']) !!}
						@else
							<p>Das Nutzerkonto <strong>ist aktiviert</strong>.</p>
							{!! HTML::link('admin/users/'. $user->id .'/deactivate-user', 'Nutzer manuell deaktieren', ['class' => 'btn btn-warning btn-sm']) !!}
						@endif

						<br><br>
						<p>Der Nutzer ist <strong>nicht gesperrt</strong>.</p>
						{!! HTML::link('admin/users/'. $user->id .'/change-status', 'Nutzer speeren', ['class' => 'btn btn-danger btn-sm']) !!}
					@endif
				@else
					@if( ! $user->activated)
						<p>Das Nutzerkonto wurde noch <strong>nicht aktiviert</strong>.</p>
						{!! HTML::link('admin/users/'. $user->id .'/send-activation-code', 'Aktivierungscode senden', ['class' => 'btn btn-warning btn-sm']) !!}
						{!! HTML::link('admin/users/'. $user->id .'/activate-user', 'Nutzer manuell aktivieren', ['class' => 'btn btn-success btn-sm']) !!}
					@else
						<p>Das Nutzerkonto <strong>ist aktiviert</strong>.</p>
						{!! HTML::link('admin/users/'. $user->id .'/deactivate-user', 'Nutzer manuell deaktieren', ['class' => 'btn btn-warning btn-sm']) !!}
					@endif

					<br><br>
					<p>Der Nutzer ist <strong>nicht gesperrt</strong>.</p>
					{!! HTML::link('admin/users/'. $user->id .'/change-status', 'Nutzer speeren', ['class' => 'btn btn-danger btn-sm']) !!}
				@endif
                <br><br>
                <p><strong>Erstellt: </strong>{{ $user->created_at }} Uhr</p>
                <p><strong>Letzer Login: </strong>{{ $user->last_login == '-' ? $user->last_login : $user->last_login . ' Uhr' }}</p>
			</div>
		</div>
		<div class="span7 alpha">
			<h2>Verknüpfte Profile</h2>
			
			@if($events->count())
				<br>
			 	<h3>Aktuelle Veranstaltungen</h3>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Datum</th>
							<th width="100px">Aktion</th>
						</tr>
					</thead>
					<tbody>
						@foreach($events as $event)
							<tr>
								<td>{{ $event->name }}</td>
								<td>
									{{ Date::monthDate($event->start_date, $event->end_date, false) .' '. Date::format($event->end_date, 'year') }}
								</td>
								<td>
									{!! HTML::imageLink('jobmesse/'. $event->slug, 'assets/img/icons/show.png', 'Anzeigen', ['target' => '_blank', 'title' => 'Anzeigen']) !!}
									{!! HTML::imageLink('admin/events/'. $event->id .'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif

			@if($past_events->count())
				<br>
				<h3>Vergangene Veranstaltungen</h3>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Datum</th>
							<th width="100px">Aktion</th>
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
									{!! HTML::imageLink('admin/events/'. $event->id .'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif

			@if($company)
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th width="100px">Aktion</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $company->name }}</td>
							<td>
								{!! HTML::imageLink('admin/companies/show/'. $company->id, 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							</td>
						</tr>
					</tbody>
				</table>
			@endif

			@if( ! $company && $events->count() == 0 && $past_events->count() == 0 )
				<p>Keine Einträge vorhanden.</p>
                {!! HTML::link('admin/events', 'Messeübersicht', ['class' => 'green'])  !!}
			@endif
		</div>
	</div>
@stop