@extends('layouts.default')

@section('title', 'Passwort zurücksetzen')

@section('metadata')
    <meta name='description' content='Passwort vergessen? Setzen Sie es hier zurück.' />
@stop


@section('content')
	<div class="span2 alpha">
		&nbsp;
		{{-- HTML::image('assets/img/icons/login.png', '') --}}
	</div>
	<div class="span6">
		@include('partials/validation_errors')

        <br>

		{!! Form::open(['url' => 'neues-passwort/'.Request::segment(2)]) !!}
			<div class="span3">
				<div class="form-group">
					<div class="input-group input-group-sm">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						{!! Form::password('password', ['class' => 'form-control input-sm', 'placeholder' => 'Passwort']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="input-group input-group-sm">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						{!! Form::password('password_confirmation', ['class' => 'form-control input-sm', 'placeholder' => 'Passwort bestätigen']) !!}
					</div>
				</div>
				<div>
					{!! Form::submit('Passwort zurücksetzen', ['class' => 'btn btn-primary btn-sm']) !!}
				</div>
			</div>
        {!! Form::close() !!}

	</div>

	<div class="span4 omega">
		<h3 class="heading-underlined--small">Neues Passwort vergeben</h3>
		<p>
			Sie haben hier die Möglichkeit ein neues Passwort zu vergeben. 
		</p>
		<p>
			Bei Fragen oder Problemen können Sie uns gerne kontaktieren.
		</p>
		<p>{!! HTML::link('kontakt', 'Kontakt', ['class' => 'green']) !!}</p>
	</div>
@stop