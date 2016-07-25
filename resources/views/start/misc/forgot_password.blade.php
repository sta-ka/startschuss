@extends('layouts.default')

@section('title', 'Passwort vergessen')

@section('content')
	<div class="col-xs-7 col-sm-6 col-md-6 col-sm-offset-1 col-md-offset-2">
		@include('partials/validation_errors')

        <br>

		{!! Form::open(['url' => 'passwort-vergessen']) !!}
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    {!! Form::text('username', Input::old('username'), ['class' => 'form-control input-sm', 'placeholder' => 'Login']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">@</span>
                    {!! Form::text('email', Input::old('email'), ['class' => 'form-control input-sm', 'placeholder' => 'E-Mail']) !!}
                </div>
            </div>
            <div>
                {!! Form::submit('Passwort zurücksetzen', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
		{!! Form::close() !!}

	</div>

	<div class="col-xs-5 col-sm-5 col-md-4">
		<h3 class="heading-underlined--small">Passwort zurücksetzen</h3>
		<p>
			Sie haben hier die Möglichkeit Ihr Passwort zurückzusetzen. 
			Sie erhalten per E-Mail einen Code mit dem Sie ein neues Passwort vergeben können.
		</p>
		<p>
			Bei Fragen oder Problemen können Sie uns gerne kontaktieren.
		</p>
		<p>{!! HTML::link('kontakt', 'Kontakt', ['class' => 'green']) !!}</p>
	</div>
@stop