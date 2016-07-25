@extends('layouts.applicant')

@section('title', 'Dashboard')

@section('content')
	<div>
		<ol class="breadcrumb">
			<li>{!! HTML::link('applicant/applications/show', 'Übersicht') !!}</li>
			<li>{!! HTML::link('applicant/applications', 'Neue Bewerbung - Übersicht') !!}</li>
			<li>{!! HTML::link('applicant/applications/event/'. $event->id, 'Bewerbung - '. $event->name ) !!}</li>
			<li class="active">{{ $company->name }}</li>
		</ol>
	</div>
	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span10 omega">
		<h3>Bewerbung für ein Einzelgespräch</h3>
		<p>{{ $event->name }}: {{ Date::monthDate($event->start_date, $event->end_date, false).' '.Date::format($event->end_date, 'year') }}</p>

		<div class="span7 alpha">
			@include('partials/validation_errors')
			
			{!! Form::open(['url' => 'applicant/applications/apply-for-interview/'. $event->id .'/'. $company->id]) !!}

			<div class="span3 alpha">
				<div class="form-group">
					{!! Form::label('company', 'Unternehmen') !!}
					{!! Form::text('company', $company->name, ['class' => 'form-control input-sm', 'disabled' => 'disabled']) !!}
				</div>
			</div>

			<div class="span7 alpha">
				<div class="form-group">
					{!! Form::label('cover_letter', 'Anschreiben') !!}
					{!! Form::textarea('cover_letter', Input::old('cover_letter'), ['class' => 'form-control input-sm', 'rows' => 15]) !!}
				</div>
				<div class="form-group">
					{!! Form::label('comment', 'Kommentar') !!}
					{!! Form::textarea('comment', Input::old('comment'), ['class' => 'form-control input-sm', 'rows' => 5]) !!}
				</div>
				{!! Form::submit('Bewerben', ['class' => 'btn btn-primary btn-sm']) !!}
			</div>

			{!! Form::close() !!}
		</div>
@stop