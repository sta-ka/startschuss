@extends('layouts.default')

@section('title', 'Registrieren')

@section('metadata')
    <meta name='description' content='Erstellen Sie einen Account auf startschuss-karriere.de.' />
@stop

@section('content')
	<div class="col-xs-7 col-sm-6 col-md-6 col-sm-offset-1 col-md-offset-2">
			@include('partials/validation_errors')

			{!! Form::open(['url' => 'registrieren']) !!}
				<div class="">
                    <br>
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
				</div>
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
                {!! Form::submit('Registrieren', ['class' => 'btn btn-primary btn-sm']) !!}
		{!! Form::close() !!}
	</div>

	<div class="col-xs-5 col-sm-5 col-md-4">
		<h3 class="heading-underlined--small">Sie sind Veranstalter?</h3>
		<p>
			Möchten Sie sich auf startschuss-karriere.de präsentieren?
		</p>
		<p>
			Dann können Sie uns gerne kontaktieren.
		</p>
		<p>{!! HTML::link('kontakt', 'Kontakt', ['class' => 'green']) !!}</p>
	</div>
@stop
