@extends('layouts.admin')

@section('title', 'Stellenangebot anzeigen')

@section('content')
	@include('admin.jobs.profile.partials.breadcrumb')

	<div class="span3 alpha">
		@include('admin.jobs.profile.partials.nav_bar')
	</div>
	<div class="span6">
		<div class="info-box span6 alpha">

            <p>Diese Anzeige wurde erstellt am {{ $job->created_at }} Uhr.</p>
            <br>

			@if($job->deleted_at)
				<p>Diese Stellenanzeige ist <strong>gelöscht</strong>.</p>
				{!! HTML::link('admin/jobs/'. $job->id .'/restore', 'Wiederherstellen', ['class' => 'btn btn-success btn-sm']) !!}
				{!! HTML::link('admin/jobs/'. $job->id .'/delete', 'Endgültig löschen', ['class' => 'btn btn-danger btn-sm']) !!}
			@elseif($job->expired)
				<p>Das Stellenangebot ist <strong>abgelaufen</strong>.</p>
			@elseif( ! $job->approved)
				<p>Das Stellenangebot wurde noch <strong>nicht freigeschaltet</strong>.</p>
				{!! HTML::link('admin/jobs/'. $job->id .'/approve-job', 'Jetzt freischalten', ['class' => 'btn btn-success btn-sm']) !!}
			@else
				<p>Das Stellenangebot <strong>ist freigeschaltet</strong>.</p>
				{!! HTML::link('admin/jobs/'. $job->id .'/cancel-approval', 'Freischaltung zurücknehmen', ['class' => 'btn btn-warning btn-sm']) !!}
				<div class="clearfix"></div>
				@if($job->active)
					<p>Das Stellenangebot ist<strong> aktiv</strong>.</p>
					{!! HTML::link('admin/jobs/'. $job->id .'/change-status', 'Deaktivieren', ['class' => 'btn btn-danger btn-sm']) !!}
				@else
					<p>Das Stellenangebot ist <strong>deaktiv</strong>.</p>
					{!! HTML::link('admin/jobs/'. $job->id .'/change-status', 'Aktivieren', ['class' => 'btn btn-success btn-sm']) !!}
				@endif
			@endif
		</div>
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop