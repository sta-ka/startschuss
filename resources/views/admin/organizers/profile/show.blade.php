@extends('layouts.admin')

@section('title', 'Veranstalter anzeigen')

@section('content')
	@include('admin.organizers.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.organizers.profile.partials.nav_bar')
	</div>
	<div class="span6">
		@if($organizer->deleted_at)
			<div class="info-box span6 alpha">
				<p>Diese Veranstaltung ist <strong>gelöscht</strong>.</p>
				{!! HTML::link('admin/organizers/'. $organizer->id .'/restore', 'Wiederherstellen', ['class' => 'btn btn-success btn-sm']) !!}
				{!! HTML::link('admin/organizers/'. $organizer->id .'/delete', 'Endgültig löschen', ['class' => 'btn btn-danger btn-sm']) !!}
			</div>
		@endif
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop