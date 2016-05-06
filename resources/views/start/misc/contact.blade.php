@extends('layouts.default')

@section('title', 'Kontakt')

@section('metadata')
	<meta name='description' content='Fragen oder Feedback? Nehmen Sie Kontakt mit startschuss-karriere.de auf.' />
	<meta name='keywords' content='karriere, jobmesse, startschuss-karriere.de, kontakt' />
@stop

@section('content')
	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span6">
		
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'kontakt']) !!}
			<div class="span3 alpha">
				<div class="form-group">
					<div class="input-group input-group-sm">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						{!! Form::text('name', Input::old('name'), ['class' => 'form-control input-sm', 'placeholder' => 'Name']) !!}
					</div>
				</div>
				<div class="form-group">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">@</span>
						{!! Form::text('email', Input::old('email'), ['class' => 'form-control input-sm', 'placeholder' => 'E-Mail']) !!}
					</div>
				</div>
			</div>
			<div class="span6 alpha">
				<div class="form-group">
					{!! Form::textarea('body', Input::old('body'), ['class' => 'form-control input-sm', 'placeholder' => 'Nachricht']) !!}
				</div>
	
				{!! Form::submit('Senden', ['class' => 'btn btn-primary btn-sm']) !!}
			</div>
			

		{!! Form::close() !!}

	</div>
	<div class="span4 omega">
		&nbsp;
	</div>
@stop