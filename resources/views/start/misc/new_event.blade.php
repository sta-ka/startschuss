@extends('layouts.default')

@section('title', 'Neue Jobmesse')

@section('metadata')
	<meta name='description' content='Möchten Sie Ihre Jobmesse auf startschuss-karriere.de präsentieren? Dann tragen Sie sie hier ein.' />
	<meta name='keywords' content='karriere, jobmesse, startschuss-karriere.de, kontakt' />
@stop

@section('scripts')
	<script type="text/javascript">

		function fadeIn(element) {

			var op = 0;  // initial opacity

			// display element, but set opacity to 0
			element.style.display = 'block';
			element.style.opacity = op;

			var timer = setInterval(function () {

				if (op >= 0.9) {
					clearInterval(timer);
					element.style.display = 'block';
				}

				element.style.opacity = op;
				element.style.filter = 'alpha(opacity=' + op * 100 + ')';
				op += 0.1;

			}, 70);
		}

		document.addEventListener('DOMContentLoaded', function() {
			var startDateLabel = document.querySelector('label[for=start_date]');
			var endDateField   = document.querySelector('#end_date');
			var multiDateField = document.querySelector('#multi-date');

			if(multiDateField.checked == false) {
				startDateLabel.innerHTML = 'Datum';
				endDateField.parentNode.style.display = 'none';
				endDateField.value = '';
			}

			multiDateField.onchange = function() {

				if(multiDateField.checked) {
					startDateLabel.innerHTML = 'Startdatum';
					fadeIn(endDateField.parentNode)
				} else {
					startDateLabel.innerHTML = 'Datum';
					endDateField.parentNode.style.display = 'none';
					endDateField.value = '';
				}
			}
		});
	</script>	
@stop

@section('content')
    <div class="col-xs-7 col-sm-6 col-md-6 col-sm-offset-1 col-md-offset-2">
		@include('partials/validation_errors')

		{!! Form::open(['url' => 'jobmesse-eintragen']) !!}

		<fieldset>
			<legend>Kontaktdaten</legend>
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    {!! Form::text('contact', Input::old('contact'), ['class' => 'form-control input-sm', 'placeholder' => 'Ansprechpartner']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">@</span>
                    {!! Form::text('email', Input::old('email'), ['class' => 'form-control input-sm', 'placeholder' => 'E-Mail']) !!}
                </div>
            </div>
		</fieldset>
		<fieldset>
			<legend>Veranstaltungsdaten</legend>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('name', 'Name der Veranstaltung') !!}
                        {!! Form::text('name', Input::old('name'), ['class' => 'form-control input-sm']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('location', 'Ort') !!}
                        {!! Form::text('location', Input::old('location'), ['class' => 'form-control input-sm']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="checkbox">
					<label>
						{!! Form::checkbox('multi_date', '1', null, ['id' => 'multi-date']) !!} Mehrtägige Veranstaltung
					</label>
				</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('start_date', 'Startdatum')!!}
                        {!! Form::text('start_date', Input::old('start_date'), ['class' => 'form-control input-sm']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('end_date', 'Enddatum')!!}
                        {!! Form::text('end_date', Input::old('end_date'), ['class' => 'form-control input-sm']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('region', 'Region') !!}
                        {!! Form::select('region', $regions, Input::old('region'), ['class' => 'form-control input-sm']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('organizer_id', 'Veranstalter') !!}
                        {!! Form::text('organizer', Input::old('organizer'), ['class' => 'form-control input-sm']) !!}
                    </div>
                </div>
            </div>
            {!! Form::submit('Erstellen', ['class' => 'btn btn-primary btn-sm']) !!}
		</fieldset>

		{!! Form::close() !!}
	</div>
@stop