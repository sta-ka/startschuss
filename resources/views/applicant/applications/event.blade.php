@extends('layouts.applicant')

@section('title', 'Neue Bewerbung')

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('applicant/applications/show', 'Übersicht') !!}</li>
			<li>{!! HTML::link('applicant/applications', 'Neue Bewerbung - Übersicht') !!}</li>
			<li class="active">Bewerbung - {{ $event->name }}</li>
		</ol>
	</div>
	<div class="span1 alpha">
		&nbsp;
	</div>	
	<div class="span10">
		<h3>{{ $event->name }}</h3>
		
		@if(count($companies))
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Aktion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($companies as $company)
						<tr>
							<td>{{ $company->name }}</td>
							<td>
								@if($company->applications->first())
									-
								@else
									{!! HTML::link('applicant/applications/apply-for-interview/'. $event->id .'/'. $company->id, 'Bewerben') !!}
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>Auf dieser Veranstaltung sind momentan keine Bewerbungen auf Einzelgespräche möglich.</p>
		@endif
	</div>
	<div class="span1 omega">
		&nbsp;
	</div>
@stop