@extends('layouts.admin')

@section('title', 'Veranstaltung anzeigen')

@section('content')
	@include('admin.events.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.events.profile.partials.nav_bar')
	</div>
	<div class="span6">
		<div class="info-box span6 alpha">
			@if($event->requested_by)
				<p>Veranstaltung beantragt durch <strong>{{ $event->requestedBy->username }}</strong>.</p>
				{!! HTML::link('admin/events/'. $event->id .'/accept-request', 'Veranstaltung eintragen', ['class' => 'btn btn-success btn-sm']) !!}
				<br>
			@elseif($event->user_id)
				<p>Diese Veranstaltung ist bereits mit einem Nutzerkonto verknüfpt.</p>
				<br>
				Nutzer: <strong>{!! HTML::link('admin/users/'. $user->id .'/show', $user->username) !!}</strong>
				{!! HTML::link('admin/events/'. $event->id .'/delete-linkage', 'Verknüpfung löschen', ['class' => 'btn btn-danger btn-sm']) !!}
				<br><br><br>
			@else
				<p>Diese Veranstaltung ist mit keinem Nutzerkonto verknüfpt.</p>

				@if($users_list)
					<br>
					{!! Form::open(['url' => 'admin/events/'. $event->id .'/add-linkage']) !!}
						<div class="row">
							<div class="col-xs-8">
								{!! Form::select('user_id', $users_list, null, ['class' => 'form-control input-sm']) !!}
							</div>
							{!! Form::submit('Mit Konto verknüpfen', ['class' => 'btn btn-success btn-sm']) !!}
						</div>
					{!! Form::close() !!}
				@else
					<p><i>Erstellen Sie den ersten Nutzer.</i></p>
				@endif
				<br>
			@endif

			@if($event->deleted_at)
				<p>Diese Veranstaltung ist <strong>gelöscht</strong>.</p>
				{!! HTML::link('admin/events/'. $event->id .'/restore', 'Wiederherstellen', ['class' => 'btn btn-success btn-sm']) !!}
				{!! HTML::link('admin/events/'. $event->id .'/delete', 'Endgültig löschen', ['class' => 'btn btn-danger btn-sm']) !!}
			@elseif(! $event->requested_by)
				@if($event->visible)
					<p>Diese Veranstaltung ist <strong>sichtbar</strong>.</p>
					{!! HTML::link('admin/events/'. $event->id .'/change-status', 'Status ändern', ['class' => 'btn btn-warning btn-sm']) !!}
				@else
					<p>Diese Veranstaltung ist <strong>nicht sichtbar</strong>.</p>
					{!! HTML::link('admin/events/'. $event->id .'/change-status', 'Status ändern', ['class' => 'btn btn-success btn-sm']) !!}
				@endif
			@endif
		</div>
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop