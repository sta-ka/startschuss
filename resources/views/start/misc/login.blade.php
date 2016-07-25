@extends('layouts.default')

@section('title', 'Login')

@section('metadata')
    <meta name='description' content='Login zu ihrem Konto auf startschuss-karriere.de.' />
@stop

@section('content')
	<div class="col-xs-7 col-sm-6 col-md-6 col-sm-offset-1 col-md-offset-2">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'login']) !!}
            <br>
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    {!! Form::text('username', Input::old('username'), ['class' => 'form-control input-sm', 'placeholder' => 'Login']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    {!! Form::password('password', ['class' => 'form-control input-sm', 'placeholder' => 'Passwort']) !!}
                </div>
            </div>

            {!! Form::submit('Login', ['class' => 'btn btn-primary btn-sm']) !!}
		{!! Form::close() !!}

	</div>

	<div class="col-xs-5 col-sm-5 col-md-4">
		<h3 class="heading-underlined--small">Passwort vergessen</h3>
		<p>
			Falls Sie Ihr Passwort vergessen haben, folgen Sie diesem Link.
		</p>
		<p>{!! HTML::link('passwort-vergessen', 'Passwort vergessen', ['class' => 'green']) !!}</p>
		<p>
			Bei Fragen oder Problemen können Sie uns gerne kontaktieren.
		</p>
		<p>{!! HTML::link('kontakt', 'Kontakt', ['class' => 'green']) !!}</p>
	</div>
@stop
