@if(Session::has('errors')) 
	<ul class="validation-errors list-unstyled">
		@foreach ($errors->toArray() as $error)
			<li>{!!  $error[0] !!}</li>
		@endforeach
	</ul>
@endif

