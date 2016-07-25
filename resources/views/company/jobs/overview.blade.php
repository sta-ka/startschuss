@extends('layouts.company')

@section('title', 'Alle Stellenangebote anzeigen')

@section('content')
	<div class="span2 alpha">
		{!! HTML::link('company/jobs/new', 'Neue Stelle', ['class' => 'btn btn-success']) !!}
	</div>
	<div class="span10 omega">
		@if($jobs->count())
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Status</th>
						<th>Endet</th>
						<th>Erstellt von</th>
						<th width="100px">Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($jobs as $job)
						<tr>
							<td title="{{ $job->title }}">{{ Str::limit($job->title, 35) }}</td>
							<td>
								@if($job->expired) 
									<span class="label label-danger">Abgelaufen</span>
								@elseif( ! $job->approved)
									<span class="label label-warning">Nicht freigeschaltet</span>
								@elseif($job->active)
									<span class="label label-success">Aktiv</span>
								@else
									<span class="label label-warning">Deaktiv</span>
								@endif
							</td>
							<td>{{ Date::format($job->expire_at, 'date') }}</td>
							<td>{{ $job->created_by }}</td>
							<td>
								{!! HTML::imageLink('company/jobs/'. $job->id .'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>Keine Einträge vorhanden.</p>
		@endif
	</div>
@stop